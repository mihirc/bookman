<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

define("_BOOKMAN_INIT",true);
include_once("private/conn.php");
include_once("private/connection_pdo.php");	

date_default_timezone_set("Asia/Calcutta");
$today = date("Y-m-d");
if(isset($_POST['add_sub_domain'])){
	
	//print_r($_POST);

	$error = '';

	//SANITIZATION OF STRINGS
	$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = MD5(filter_var($_POST['password']));
	$subdomain = filter_var($_POST['subdomain'],FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

	//VALIDATION
	if($username == ""){
		$error .= "Please enter a valid username<br />";
	}

	if($password == ''){
		$error .= "Please enter a valid password<br />";
	}

	if($subdomain == ''){
		$error .= 'Please enter a Sub Domain<br />';
	}

	if($email == ''){
		$error .='Please enter a valid Email Id<br />';
	}

	if(!$error){
		echo 'gets till no errors';
		global $db;
		print_r($db);
		$checkavailability = $db->get_var("SELECT COUNT(*) FROM qzbm_clients_subdomains WHERE qzbmc_subdomain='$subdomain' OR qzbmc_emailid='$email'");
		$db->debug();
		if($checkavailability == 0){
			echo '123123213123';
			$username_fetcher = PasswordGenerator("1");	
			$decoded = json_decode($username_fetcher,true);
		
			$username_db = $decoded['results'][0]['randompassword']['username'];
			$password_db = $decoded['results'][0]['randompassword']['password'];
			
			//$trial = SubDomainCreate($subdomain,$username_db,$password_db);	


			$insert = $db->query("INSERT INTO qzbm_clients_subdomains VALUES ('','','$username','$password','$subdomain','','$today','1','$username_db','$password_db')");
			if($insert){
			$success = 'data inserted successfully!';
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create my Demo || BookMan</title>
	<link rel="stylesheet" type="text/css" href="css/signup.css">
	<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
</head>
<body>

<header class="global-header">
<div>
<nav class="global-nav">
<a class="logo" href="/">
<img width="150" title="BookMan" alt="BookMan">
</a>
</nav>
</div>
</header>
  <section class="login">
<form id="login-form" method="post" action="">
<h1>Try BookMan free for 30 days</h1>


<?php if(isset($error) && $error !=''){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>
<?php if(isset($success) && $success !=''){ ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>

	<input type="text" value="" placeholder="Your Name" tabindex="20" name="name">
	<input type="text" value="" placeholder="Username" tabindex="20" name="username">
	<input type="email" value="" placeholder="you@yourcompany.com" tabindex="20"  name="email" />
	<input type="password" value="" placeholder="*******" tabindex="20"  name="password" />

 <div class="password-container">
	<input type="text" placeholder="company" tabindex="21" name="subdomain">
	<span>
		.bookman.in
	</span>
</div>
<button type="submit" name="add_sub_domain" value="testing" class="button submit">Blah</button>

 </form>   
  </section>
    


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script rel="javascript" src="js/signup.js" type="text/javascript"></script>

</body>
</html>