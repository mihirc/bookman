<?php
define("_BOOKMAN_INIT",true);
require_once("private/conn.php");
//require_once("definitions.php");
date_default_timezone_set("Asia/Calcutta");
$today = date("Y-m-d");
if(isset($_POST['add_sub_domain'])){
	
	$error = '';

	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = MD5(filter_var($_POST['password']));
	$subdomain = filter_var($_POST['subdomain'],FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
	if($username == ""){
		$error .= "Please enter a valid name";
	}

	if($password == ''){
		$error .= "Please enter a valid password";
	}

	if($subdomain == ''){
		$error .= 'Please enter a subdomain';
	}

	if($email == ''){
		$error .='Please enter a valid email id';
	}

	if(!$error){

		$checkavailability = $db->get_var(SELECT COUNT(*) FROM gzbm_clients_subdomains WHERE qzbmc_subdomain="$subdomain");
		if($checkavailability == 0){
			$insert = $db->query("INSERT INTO qzbm_clients_subdomains VALUES ('','','$username','$password','$subdomain','$today','1')");
			if($insert){
			echo 'data inserted successfully!';
			}

		} else{
			$error .="This subdomain is already registered. Please try another one!";

		}				
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
<?php if(isset($error)){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>
	<form method="post" action="">
		<input type="text" name="username" />
		<input type="password" name="password" />
		<input type="text" name="subdomain" />
		<input type="email" name="email" />
		<input type="submit" name="add_sub_domain" />
	</form>



</div>
</body>
</html>