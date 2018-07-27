<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 22/5/18
 * Time: 11:03 PM
 */

include_once '../../../php/send.php';
$userClass = new Send();
$mid = $_GET['msgId'];
$uid = $_GET['uid'];
if ($userClass->msgUser($mid) && $userClass->removeChatHistory($mid)) {
    header("Location:../history/?uid=$uid");
}else{
    echo '<a href="../history/?uid='.$uid.'">Back</a><br>';
    die('Error : Cannot delete message');
}
?>