<?php
include('function/config.ini.php');
include('function/db.ini.php');
include('function/function.ini.php');
include('function/setting.ini.php');             
$DB_TBLName = isset($_GET['tabel'])? $_GET['tabel'] : "inquiry" ;
//edit this to suit your needs
$sql = "SELECT * FROM $DB_TBLName";
$Use_Title = 1;
//define date for title: EDIT this to create the time-format you need
$now_date = DATE('m-d-Y H:i');
//define title for .doc or .xls file: EDIT this if you want
$title = " You are Watching Record Of " . $DB_TBLName;
//execute query
$result = @MYSQL_QUERY($sql) or DIE("Couldn't execute query:<br>" . MYSQL_ERROR(). "<br>" . MYSQL_ERRNO());
$w = 0;
//if this parameter is included ($w=1), file returned will be in word format ('.doc')
//if parameter is not included, file returned will be in excel format ('.xls')
IF (ISSET($w) && ($w==1))
{
     $file_type = "msword";
     $file_ending = "doc";
}ELSE {
     $file_type = "vnd.ms-excel";
     $file_ending = "xls";
}
//header info for browser: determines file type ('.doc' or '.xls')
HEADER("Content-Type: application/xls");
HEADER("Content-Disposition: attachment; filename=".$now_date."-".$DB_TBLName.".xls");
HEADER("Pragma: no-cache");
HEADER("Expires: 0");
/*    Start of Formatting for Word or Excel    */
IF (ISSET($w) && ($w==1)) //check for $w again
{
     /*    FORMATTING FOR WORD DOCUMENTS ('.doc')   */
     //create title with timestamp:
     IF ($Use_Title == 1)
     {
         ECHO("$title\n\n");
     }
     //define separator (defines columns in excel & tabs in word)
     $sep = "\n"; //new line character

     WHILE($row = MYSQL_FETCH_ROW($result))
     {
         //set_time_limit(60); // HaRa
         $schema_insert = "";
         FOR($j=0; $j<mysql_num_fields($result);$j++)
         {
         //define field names
         $field_name = MYSQL_FIELD_NAME($result,$j);
         //will show name of fields
         $schema_insert .= "$field_name:\t";
             IF(!ISSET($row[$j])) {
                 $schema_insert .= "NULL".$sep;
                 }
             ELSEIF ($row[$j] != "") {
                 $schema_insert .= "$row[$j]".$sep;
                 }
             ELSE {
                 $schema_insert .= "".$sep;
                 }
         }
         $schema_insert = STR_REPLACE($sep."$", "", $schema_insert);
         $schema_insert .= "\t";
         PRINT(TRIM($schema_insert));
         //end of each mysql row
         //creates line to separate data from each MySQL table row
         PRINT "\n----------------------------------------------------\n";
     }
}ELSE{
     /*    FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
     //create title with timestamp:
     IF ($Use_Title == 1)
     {
         ECHO("$title\n");
     }
     //define separator (defines columns in excel & tabs in word)
     $sep = "\t"; //tabbed character

     //start of printing column names as names of MySQL fields
     FOR ($i = 0; $i < MYSQL_NUM_FIELDS($result); $i++)
     {
         ECHO MYSQL_FIELD_NAME($result,$i) . "\t";
     }
     PRINT("\n");
     //end of printing column names

     //start while loop to get data
     WHILE($row = MYSQL_FETCH_ROW($result))
     {
         //set_time_limit(60); // HaRa
         $schema_insert = "";
         FOR($j=0; $j<mysql_num_fields($result);$j++)
         {
             IF(!ISSET($row[$j]))
                 $schema_insert .= "NULL".$sep;
             ELSEIF ($row[$j] != "")
                 $schema_insert .= "$row[$j]".$sep;
             ELSE
                 $schema_insert .= "".$sep;
         }
         $schema_insert = STR_REPLACE($sep."$", "", $schema_insert);
         //following fix suggested by Josue (thanks, Josue!)
         //this corrects output in excel when table fields contain \n or \r
         //these two characters are now replaced with a space
         $schema_insert = PREG_REPLACE("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
         $schema_insert .= "\t";
         PRINT(TRIM($schema_insert));
         PRINT "\n";
     }
}
?>