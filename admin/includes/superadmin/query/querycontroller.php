
<?php
//$adid=$_SESSION['ad_id'];
if(isset($_POST['ad_submit']))
	{

global $query;
	$name = $_POST['ad_name'];
	$username = $_POST['ad_username'];
	$password = md5($_POST['ad_password']);

$usertype = $_POST['ad_usertype'];
	
	
$status = $_POST['ad_status'];


if(isset($_GET['ed_id']))
	{
		$id=$_GET['ed_id'];
$sql=$db->query ("UPDATE admin SET ad_name='$name',ad_username='$username',ad_password='$password',ad_usertype='$usertype',ad_status='$status' WHERE ad_id='$id'");

if($sql)
{

	$msg = "<div class='alert alert-success'>Updated Sucessfuly</div>";
}

	}

	else
	{

	$query=$db->query("insert into admin values('','$name','$username','$password','$usertype','$status')");

	}
		
	
	
	
	//$db->debug();


	if($query)
	
	{
	$msg = "<div class='alert alert-success'>Inserted Sucessfuly</div>";
	
	}
else
{
//echo "fail";
 }
}



//////////////////////////////////////////////////////////////////////////////////////////EDIT


if(isset($_GET['row1_id']))
						{
	
	
	if(isset($_POST['loc_edit']))
	{
	$location = $_POST['loc_location'];
	
	
	
	
	if($sql)
	
	{
	
	echo "Update Redord Successfully";
	}
else
{
echo "fail";
 }
}
}


//////////////////////////////////////////////////////////////////////////////////delete


			
							
if(isset($_GET['row_id']))
{


$id=$_GET['row_id'];

// sql to delete a record
$sql = $db->query("UPDATE location SET loc_status='2' WHERE loc_id=$id");

if ($sql)
{
    header('location:'.$_SERVER['HTTP_REFERER']);
    echo "Record deleted successfully";
}
 else
 {
    echo "Error deleting record: "; //. $conn->error;
 }
}







if(isset($_POST['sendemail']))
{


$fromemail="amit@thoughtfulviewfinder.in";

$message=$_POST['email_text'];


$clid=$_GET['cl_id'];

$clemailquery=$db->get_row("SELECT * FROM qzbm_clients_subdomains WHERE qzmbc_id='$clid'");

if($clemailquery)
{
	$msg="<div class='alert alert-success'><b>E-mail Sent..</b></div>";
}

$clemail=$clemailquery->qzbmc_emailid;

//echo "email=".$clemail;

$emailarray = json_encode(array(array('name'=>'Amit Borgaonkar','email'=>$clemail,'type'=>'to')));

$html = $message;
        $subject = "Welcome to BookMan";
        $message= "";
        $subaccount = "globenbeyond";
        $fromemail="amit@thoughtfulviewfinder.in";
        $replytoemail="amit@thoughtfulviewfinder.in";
        $fromname="BookMan";
        $attachmentarray=null;

//echo $html;

        MandrillEmail($fromemail, $subject, $replytoemail,$fromname, json_encode($html), $attachmentarray, $emailarray, $subaccount);



}


?>
