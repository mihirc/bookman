
<?php
//include_once("../private/resources/emaildesign/signup.php");


if(isset($_POST['sendemail']))
{


//$fromemail="amit@thoughtfulviewfinder.in";

$message=$_POST['email_text'];


$clid=$_GET['cl_id'];

$clemailquery=$db->get_row("SELECT * FROM qzbm_clients_subdomains WHERE qzmbc_id='$clid'");

if($clemailquery)
{
	$msg="<div class='alert alert-success'><b>E-mail Sent..</b></div>";
}

$clemail=$clemailquery->qzbmc_emailid;

//echo "email=".$clemail;

$content = getTemplate('../private/resources/emaildesign/signup.php', 'msg', 'name', 'uname', 'pwd');

$emailarray = json_encode(array(array('name'=>'Amit Borgaonkar','email'=>$clemail,'type'=>'to')));

$html = $content;
        $subject = "Welcome to BookMan";
        $message= "";
        $subaccount = "globenbeyond";
        $fromemail="noreply@bookman.in ";
        $replytoemail="amit@thoughtfulviewfinder.in";
        $fromname="BookMan";
        $attachmentarray=null;

//echo $html;

        MandrillEmail($fromemail, $subject, $replytoemail,$fromname, json_encode($html), $attachmentarray, $emailarray, $subaccount,$clid);



}


?>
