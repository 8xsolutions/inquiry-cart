<?php
  include('function/config.ini.php');
  include('function/db.ini.php');
  include('function/function.ini.php');
  include('function/setting.ini.php');
  logout($config['key']);
  echo redirect($config['admin_url'].'login.php');