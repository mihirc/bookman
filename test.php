<?php
require 'private/resources/sendgrid/vendor/autoload.php'; 
$sendgrid = new SendGrid('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');
$email = new SendGrid\Email();
$email
    ->addTo('amit@thoughtfulviewfinder.in')
    ->setFrom('info@bookman.in', 'Thoughtfulviewfinder Services')
    ->setSubject('Subject goes here')
    ->setText('Hello World!')
    ->addUniqueArg("foliage_message_id", "22")
    ->addUniqueArg("foliage_customer_id", "22")
    ->setHtml('<strong>Hello World!</strong>');

$response=$sendgrid->send($email);
?>