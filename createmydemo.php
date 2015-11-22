<?php
define("_BOOKMAN_INIT",true);
require_once("private/conn.php");




//require_once("definitions.php");
date_default_timezone_set("Asia/Calcutta");
$today = date("Y-m-d");
if(isset($_POST['add_sub_domain'])){
	
	$error = '';

	//SANITIZATION OF STRINGS
	$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = MD5(filter_var($_POST['password']));
	$subdomain = filter_var($_POST['subdomain'],FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

	//VALIDATION
	if($username == ""){
		$error .= "Please enter a valid username";
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

		$checkavailability = $db->get_var("SELECT COUNT(*) FROM qzbm_clients_subdomains WHERE qzbmc_subdomain='$subdomain' OR qzbmc_emailid='$email'");
		if($checkavailability == 0){

			$username_fetcher = PasswordGenerator("1");	
			$decoded = json_decode($username_fetcher,true);
		
			$username_db = $decoded['results'][0]['randompassword']['username'];
			$password_db = $decoded['results'][0]['randompassword']['password'];
			

			$insert = $db->query("INSERT INTO qzbm_clients_subdomains VALUES ('','','$username','$password','$subdomain','','$today','1','$username_db','$password_db')");
			if($insert){
			echo 'data inserted successfully!';
			}

		} else{
			$error .="This subdomain / email ID is already registered. Please try another one!";

		}				
	}
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Create my Demo || BookMan</title>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
<div>
<?php if(isset($error)){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>
	<form method="post" action="">

		<input type="text" name="name" />
		<input type="text" name="username" />
		<input type="password" name="password" />
		<input type="text" name="subdomain" />
		<input type="email" name="email" />
		<input type="submit" name="add_sub_domain" />
	</form>
</div>


<!-- multistep form -->
<form id="msform">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Account Setup</li>
		<li>Social Profiles</li>
		<li>Personal Details</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">This is step 1</h3>
		<input type="text" name="email" placeholder="Email" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Social Profiles</h2>
		<h3 class="fs-subtitle">Your presence on the social network</h3>
		<input type="text" name="twitter" placeholder="Twitter" />
		<input type="text" name="facebook" placeholder="Facebook" />
		<input type="text" name="gplus" placeholder="Google Plus" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We will never sell it</h3>
		<input type="text" name="fname" placeholder="First Name" />
		<input type="text" name="lname" placeholder="Last Name" />
		<input type="text" name="phone" placeholder="Phone" />
		<textarea name="address" placeholder="Address"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
	</fieldset>
</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script rel="javascript" src="js/signup.js" type="text/javascript"></script>

</body>
</html>