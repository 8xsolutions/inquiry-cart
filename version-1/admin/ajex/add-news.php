<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    $content = mysql_real_escape_string($_POST['content']);
    $title = mysql_real_escape_string($_POST['title']);
    date('Y/M/D');
    $q = mysql_query("INSERT INTO `news`(`id`, `title`, `date`, `content`) VALUES (NULL,'{$title}','{$date}','{$content}')");
    if ($q) {
        echo success(' Your New News Add');
        echo '<meta http-equiv="refresh" content="0; url=news.php">';
    }else{
        echo error(mysql_error());
    }
}
?>
