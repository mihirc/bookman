
<?php
//include_once("../private/resources/emaildesign/signup.php");


if(isset($_POST['sendemail']))
{


//$fromemail="amit@thoughtfulviewfinder.in";

$message=$_POST['email_text'];

$subject=$_POST['subject'];


$clid=$_GET['cl_id'];

$clemailquery=$dbqzbmc->get_row("SELECT * FROM qzbm_clients_subdomains WHERE qzmbc_id='$clid'");

if($clemailquery)
{
	$msg="<div class='alert alert-success'><b>E-mail Sent..</b></div>";
}

$clemail=$clemailquery->qzbmc_emailid;

//echo "email=".$clemail;

$content = getTemplate('../private/resources/emaildesign/signup3.php', 'msg', $clemailquery->qzbmc_name, $message, '');

$emailarray = json_encode(array(array('name'=>'Amit Borgaonkar','email'=>$clemail,'type'=>'to')));

$html = $content;
        //$subject = "Welcome to BookMan";
        //$message= "";
        $subaccount = "globenbeyond";
        $fromemail="noreply@bookman.in ";
        $replytoemail="amit@thoughtfulviewfinder.in";
        $fromname="BookMan";
        $attachmentarray=null;

//echo $html;

        MandrillEmail($fromemail, $subject, $replytoemail,$fromname, json_encode($html), $attachmentarray, $emailarray, $subaccount,$clid);



}


?>
