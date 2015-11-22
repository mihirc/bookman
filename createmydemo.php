<?php
define("_BOOKMAN_INIT",true);
require_once("private/conn.php");
require_once("definitions.php");
date_default_timezone_set("Asia/Calcutta");
$today = new Date();
if(isset($_POST)){
$username = filter_var($_POST['username']);
$password = MD5(filter_var($_POST['password']));
$subdomain = filter_var($_POST['subdomain']);

$insert = $db->query("INSERT INTO #_clients_subdomains VALUES ('','','$username','$password','$subdomain','$today','1')");
if($insert){
echo 'data inserted successfully!';


}


}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Create my Demo || BookMan</title>
</head>
<body>
<div>
	<form method="post" action="">
		<input type="text" name="username" />
		<input type="password" name="password" />
		<input type="text" name="subdomain" />

		<input type="submit" name="add_sub_domain" />



	</form>



</div>
</body>
</html>