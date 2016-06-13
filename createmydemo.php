<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

define("_BOOKMAN_INIT",true);
require_once("private/conn.php");
require_once("private/connection_pdo.php");	
require_once("private/functions.php");

date_default_timezone_set("Asia/Calcutta");
$today = date("Y-m-d");
if(isset($_POST['add_sub_domain'])){


//print_r($dbqzbmc);

	$error = '';

	//SANITIZATION OF STRINGS
	$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
	$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
  $textpassword = filter_var($_POST['password']);
	$password = MD5(filter_var($_POST['password']));


	$subdomain = strtolower(filter_var($_POST['subdomain'],FILTER_SANITIZE_STRING));
	$email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

  $mailid = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

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








		$checkavailability = $dbqzbmc->get_var("SELECT COUNT(*) FROM qzbm_clients_subdomains WHERE qzbmc_subdomain='$subdomain' OR qzbmc_emailid='$email'");
		
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

			$insert = $dbqzbmc->query("INSERT INTO qzbm_clients_subdomains VALUES ('','$name','$username','$password','$subdomain','$email','$today','1','','')");

$clid=$dbqzbmc->insert_id;

			if($insert){



$content = '<?php
defined("_BOOKMAN_INIT") or die("Direct permission to this file disallowed");
';

$myfile = fopen("access/$subdomain.php", "w") or die("Unable to open file!");
fwrite($myfile, $content);

//$subdomainlower=strtolower($subdomain);

$array = array();

$array['dbname'] = $subdomain;
$array['username'] = $username_db;
$array['password'] = $password_db;
$array['expirydate'] = date("Y-m-d",strtotime("+14 days"));
$string = json_encode($array);

$content='$string='."'".$string."';



";
fwrite($myfile, $content);

$content='$version=2;

?>';

fwrite($myfile, $content);


fclose($myfile);

$decode=json_decode($string);

$newdb= new ezSQL_mysql($decode->username,$decode->password,$decode->dbname,'localhost');


$date=date('Y-m-d');

$temp='<table style="width: 100%; border-bottom: 1px solid grey;" border="0">
<tbody>
<tr>
<td>[company_address]</td>
<td align="right">[company_logo]</td>
</tr>
</tbody>
</table>
<p><font size="4"><strong>Batch Detail</strong></font></p>
<table style="width: 1011px; height: 55px;" border="1">
<tbody>
<tr>
<td style="background-color: #4f5b61;" align="left"><font color="#FFFFFF">Camp Date</font></td>
<td><strong>[start_date]</strong> To<strong> [end_date]</strong> - Time<strong> [start_time]</strong> -<strong> [end_time]</strong></td>
</tr>
<tr>
<td style="background-color: #4f5b61;" align="left"><font color="#FFFFFF">Catgory</font></td>
<td><strong>[category_name]</strong></td>
</tr>
</tbody>
</table>
<p><font size="4"><strong>Member Detail</strong></font></p>
<table style="border: 1px solid #c4c4c4; width: 100%;" border="1">
<tbody>
<tr>
<td style="background-color: #4f5b61;" align="left"><font color="#FFFFFF">Name</font></td>
<td>[name]</td>
</tr>
<tr>
<td style="background-color: #4f5b61;" align="left"><font color="#FFFFFF">Email</font></td>
<td>[email]</td>
</tr>
<tr>
<td style="background-color: #4f5b61;" align="left"><font color="#FFFFFF">Contact No</font></td>
<td align="left">[contact_no]</td>
</tr>
</tbody>
</table>
<p><font size="4"><strong><br />&nbsp;</strong></font></p>
<p><font size="4"><strong>Payment History</strong></font></p>
<table style="width: 100%;" border="1">
<tbody>
<tr style="background-color: #4f5b61;">
<td><font color="#FFFFFF">Date</font></td>
<td><font color="#FFFFFF">Method</font></td>
<td><font color="#FFFFFF">Amount</font></td>
</tr>
<tr>
<td colspan="3">[payment_history]</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="width: 100%;" border="0">
<tbody>
<tr>
<td align="left">[company_name]</td>
<td><br /><br /></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>';




$queries = array( "CREATE TABLE IF NOT EXISTS `admin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` text NOT NULL,
  `ad_email` text NOT NULL,
  `ad_username` text NOT NULL,
  `ad_password` text NOT NULL,
  `ad_usertype` text NOT NULL,
  `ad_status` text NOT NULL,
  `ad_flag` text NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


 "CREATE TABLE IF NOT EXISTS `template` (
  `tem_id` int(11) NOT NULL AUTO_INCREMENT,
  `tem_name` varchar(30) NOT NULL,
  `tem_code` text NOT NULL,
  PRIMARY KEY (`tem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",



"CREATE TABLE IF NOT EXISTS `company_details` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `company_phone` text NOT NULL,
  `company_email` text NOT NULL,
  `company_address` text NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;",


"CREATE TABLE IF NOT EXISTS `member_sms` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `ms_credits` int(11) NOT NULL,
  `ms_date` date NOT NULL,
  `ms_status` text NOT NULL,
  `notification` text NOT NULL,
  PRIMARY KEY (`ms_id`)
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
",

"INSERT INTO admin VALUES ('','$name','$email','$username','$password','1','1','0')",



"INSERT INTO member_sms VALUES ('','','100','$date','1','')"




"INSERT INTO template VALUES ('5','Invoice','$temp')";



);

//added
foreach($queries as $firstquery){


$create=$newdb->query($firstquery);

}

$success = 'Your Account was successfully created. Please visit <a href="http://'.$subdomain.'.bookman.in">your new domain</a> to start using BookMan. <br /> Also, check your inbox. We have sent you an email with additional details.';

// $emailarray = json_encode(array(array('name'=>$name,'email'=>$email,'type'=>'to')));
// $emailarray1 = json_encode(array(array('name'=>'Mihir Chhatre','email'=>'mihir@thoughtfulviewfinder.in','type'=>'to')));
 $msg = $subdomain.'.bookman.in';

// 			
			

       $content = getTemplate('private/resources/emaildesign/signup.php', $msg, $name, $username, $textpassword);

//         $html = $content;
//         $subject = "Welcome to BookMan";
//         $message= "";
//         $subaccount = "globenbeyond";
//         $fromemail="noreply@bookman.in";
//         $replytoemail="noreply@bookman.in";
//         $fromname="BookMan";
//         $attachmentarray=null;



//         MandrillEmail($fromemail, $subject, $replytoemail,$fromname, json_encode($html), $attachmentarray, $emailarray, $subaccount,$clid);
  
//         MandrillEmail($fromemail, $subject, $replytoemail,$fromname, json_encode($html), $attachmentarray, $emailarray1, $subaccount,$clid);
  


require 'private/resources/sendgrid/vendor/autoload.php'; 
$sendgrid = new SendGrid('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');
$email = new SendGrid\Email();
$email
    ->addTo($mailid)
    ->setFrom('info@bookman.in', 'Thoughtfulviewfinder Services')
    ->setSubject('Welcome to Bookman')
    ->setText('Hello World!')
    ->addUniqueArg("foliage_message_id", "22")
    ->addUniqueArg("foliage_customer_id", "22")
    ->setHtml($content);

$response=$sendgrid->send($email);









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
<h1>Try BookMan free for 14 days</h1>


<?php if(isset($error) && $error !=''){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>
<?php if(isset($success) && $success !=''){ ?>
<div class="success"><?php echo $success; ?></div>
<?php } else { ?>

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
<button type="submit" name="add_sub_domain" value="testing" class="button submit">Create my Account!</button>
<?php } ?>
 </form>   
  </section>
    


<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script rel="javascript" src="js/signup.js" type="text/javascript"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70712508-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>