<?php
defined("_BOOKMAN_INIT") or die("direct access to this resource is not allowed");

function getTemplate($file, $msg=null, $name=null, $username=null, $password=null) {

    ob_start(); // start output buffer

    include $file;
    $template = ob_get_contents(); // get contents of buffer
    ob_end_clean();
    return $template;

}

function MandrillEmail($fromemail, $subject, $replyto,$fromname, $message, $attachmentarray, $emailarray, $subaccount){
	
	$messagetext = json_decode($message);
	
	require_once ('resources/Mandrill.php');
	$mandrill = new Mandrill('2_9hFayIJLuag-YEnJVdYQ');
	
	try {
    $message = array(
        'html' => $messagetext,
        'text' => $messagetext,
        'subject' => $subject,
        'from_email' => $fromemail,
        'from_name' => $fromname,
        'to' => json_decode($emailarray),
        'headers' => array('Reply-To' => $replyto),
        'important' => 1,
        'track_opens' => 1,
        'track_clicks' => 1,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => 1,
        'url_strip_qs' => 1,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'subaccount' => $subaccount,
        'signing_domain' => 'pravas-soft.com',
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at=null);

} catch(Mandrill_Error $e) {
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    throw $e;
}
	
	
}



?>