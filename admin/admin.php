<?php

define("_BOOKMAN_INIT",true);

session_start();

global $db;

//print_r($_SESSION);


if(!isset($_SESSION['ad_id']))
{

header('location:login.php');
}


include_once("../private/conn.php");

$view=$db->get_results("SELECT * FROM qzbm_clients_subdomains");

$db->debug();



?>