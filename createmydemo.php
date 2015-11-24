<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

define("_BOOKMAN_INIT",true);
require_once("private/conn.php");
require_once("private/connection_pdo.php");	

date_default_timezone_set("Asia/Calcutta");
$today = date("Y-m-d");
if(isset($_POST['add_sub_domain'])){


//print_r($db);

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








		$checkavailability = $db->get_var("SELECT COUNT(*) FROM qzbm_clients_subdomains WHERE qzbmc_subdomain='$subdomain' OR qzbmc_emailid='$email'");
		
		//$db->debug();


		if($checkavailability == 0){
			
			$username_fetcher = PasswordGenerator("1");	
			$decoded = json_decode($username_fetcher,true);
			 
			$username_db = str_replace("'", "", $decoded['results'][0]['randompassword']['username']);

			//echo"usernm".$username_db;

			$password_db = str_replace("'", "", $decoded['results'][0]['randompassword']['password']);

			//echo "pwd".$password_db;			
			
			if(($username_db!='') && ($password_db!='')){
			$trial = SubDomainCreate($subdomain,$username_db,$password_db);	

			$insert = $db->query("INSERT INTO qzbm_clients_subdomains VALUES ('','$name','$username','$password','$subdomain','$email','$today','1','','')");
			if($insert){



$content = '<?php
defined("_BOOKMAN_INIT") or die("Direct permission to this file disallowed");
';

$myfile = fopen("access/$subdomain.php", "w") or die("Unable to open file!");
fwrite($myfile, $content);



$array = array();

$array['dbname'] = $subdomain;
$array['username'] = $username_db;
$array['password'] = $password_db;

$string = json_encode($array);

$content='$string='."'".$string."';

?>";
fwrite($myfile, $content);

fclose($myfile);

$decode=json_decode($string);

$newdb= new ezSQL_mysql($decode->username,$decode->password,$decode->dbname,'localhost');



$queries = array( "CREATE TABLE IF NOT EXISTS `admin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ps_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `ad_name` text NOT NULL,
  `ad_username` text NOT NULL,
  `ad_password` text NOT NULL,
  `ad_usertype` text NOT NULL,
  `ad_status` text NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


 "CREATE TABLE IF NOT EXISTS `template` (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_name` varchar(30) NOT NULL,
  `tem_code` text NOT NULL,
  PRIMARY KEY (`tem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `smstrack` (
  `strack_id` int(11) NOT NULL AUTO_INCREMENT,
  `strack_number` text NOT NULL,
  `strack_dlrstatus` text NOT NULL,
  `strack_senttime` text NOT NULL,
  `strack_dlrtime` text NOT NULL,
  `strack_msgtext` text NOT NULL,
  `type` text NOT NULL,
  `group_id` int(11) NOT NULL,
  `mss_id` int(11) NOT NULL,
  PRIMARY KEY (`strack_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",




"CREATE TABLE IF NOT EXISTS `batch` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` text NOT NULL,
  `b_cat` text NOT NULL,
  `b_s_date` date NOT NULL,
  `b_e_date` date NOT NULL,
  `b_fee` text NOT NULL,
  `b_status` text NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",



"CREATE TABLE IF NOT EXISTS `member_sms_credits` (
  `mss_id` int(11) NOT NULL AUTO_INCREMENT,
  `mss_aid` int(11) NOT NULL,
  `mss_text` text NOT NULL,
  `mss_json` text NOT NULL,
  `mss_date` datetime NOT NULL,
  `mss_status` int(11) NOT NULL,
  `type` text NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`mss_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `invoice_payments` (
  `inp_id` int(11) NOT NULL AUTO_INCREMENT,
  `inp_in_id` int(11) NOT NULL,
  `inp_amt` varchar(100) NOT NULL,
  `inp_date` datetime NOT NULL,
  `inp_method` varchar(100) NOT NULL,
  `inp_tid` varchar(100) NOT NULL,
  `ad_id` int(11) NOT NULL,
  `inp_status` text NOT NULL,
  PRIMARY KEY (`inp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `invoice_items` (
  `init_id` int(11) NOT NULL AUTO_INCREMENT,
  `init_in_id` int(11) NOT NULL,
  `init_desc` text NOT NULL,
  `init_amt` varchar(100) NOT NULL,
  `init_type` text NOT NULL,
  `init_status` int(11) NOT NULL,
  PRIMARY KEY (`init_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `invoice` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_datecreated` date NOT NULL,
  `in_time` time NOT NULL,
  `in_m_id` int(11) NOT NULL,
  `in_amt` varchar(100) NOT NULL,
  `in_discount` varchar(100) NOT NULL,
  `in_status` text NOT NULL,
  `in_comment` text NOT NULL,
  `in_b_id` int(11) NOT NULL COMMENT 'batch id',
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
",

"CREATE TABLE IF NOT EXISTS `batch` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` text NOT NULL,
  `b_cat` text NOT NULL,
  `b_s_date` date NOT NULL,
  `b_e_date` date NOT NULL,
  `b_fee` text NOT NULL,
  `b_status` text NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
",

"CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(255) NOT NULL,
  `cust_phone` text NOT NULL,
  `cust_email` text NOT NULL,
  `cust_address` text NOT NULL,
  `cust_dob` date NOT NULL,
  `cust_status` int(11) NOT NULL,
  `cust_dor` date NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `customer_batch` (
  `cb_id` int(11) NOT NULL AUTO_INCREMENT,
  `cb_b_id` int(11) NOT NULL,
  `cb_cust_id` int(11) NOT NULL,
  `cb_dor` date NOT NULL,
  `cb_amount` text NOT NULL,
  `cb_status` int(11) NOT NULL,
  PRIMARY KEY (`cb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
",

"CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) NOT NULL,
  `c_status` int(11) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
"





);


foreach($queries as $firstquery){


$create=$newdb->query($firstquery);

}


			$success = 'data inserted successfully!';
			}
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