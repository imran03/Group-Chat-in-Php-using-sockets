<?php
include_once '../php/send.php';
$userClass = new Send();
$uid = $_GET['uid'];
if ($userClass->isAdmin() && $userClass->removeUserAndMessages($uid)) {
    header("Location:../");
} else {
    header("Location:../");
}
?>