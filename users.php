<?php
include_once('php/send.php');
$recid = 10;
$testsql=new Send();
$sql = $this->db->query("SELECT sender_id, message_text, created_time FROM privatechat
WHERE receiver_id = $recid
ORDER BY created_time DESC");

echo $sql;
?>