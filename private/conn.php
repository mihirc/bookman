<?php

defined("_BOOKMAN_INIT") or die("Direct permission to this file disallowed");

include_once("core.php");
include_once("mysql.php");
$db = new ezSQL_mysql('','','','localhost');
global $db;
?>