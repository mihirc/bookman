emailcron.php<?php

require_once ('../private/resources/Mandrill.php');
require_once("../private/conn.php");

// $mandrill = new Mandrill('2_9hFayIJLuag-YEnJVdYQ');
//     $id = '487392e6f2314c7689eb64aa3b001a3e';
//     $result = $mandrill->messages->info($id);
//     print_r($result);
?>









<?php
// try {
//     $mandrill = new Mandrill('2_9hFayIJLuag-YEnJVdYQ');
//     $id = '29419dc12bfd41ffa67f1ae79bce1480';
//     $result = $mandrill->messages->info($id);
//     print_r($result);
    
// } catch(Mandrill_Error $e) {
//     // Mandrill errors are thrown as exceptions
//     echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
//     // A mandrill error occurred: Mandrill_Unknown_Message - No message exists with the id 'McyuzyCS5M3bubeGPP-XVA'
//     throw $e;
// }






$mandrill = new Mandrill('2_9hFayIJLuag-YEnJVdYQ');

$email=$dbqzbmc->get_results("SELECT * FROM email_details WHERE status='1'");
//$db->debug();
if($email)
{

foreach($email as $em)
{

	$result = $mandrill->messages->info($em->ed_email_id);
	$json=json_encode($result);

echo $em->ed_email_id;

	$update=$dbqzbmc->query("UPDATE email_details SET ed_json='$json' WHERE ed_email_id='$em->ed_email_id'");


}

}

else
{
	echo "NO Results";
}
header('location:'.$_SERVER['HTTP_REFERER']);

?>