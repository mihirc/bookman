<?php

require_once ('../private/resources/Mandrill.php');
require_once("../private/conn.php");
$id=$_GET['e_id'];

$mandrill = new Mandrill('2_9hFayIJLuag-YEnJVdYQ');

    //$id = 'e0e2223abfde4069a65b72ba991f9d42';

    $result = $mandrill->messages->content($id);

    echo $result['html']; 
?>