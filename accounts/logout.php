<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
Home
<style><!--
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    h1 {
        font-family: 'Georgia', Times New Roman, Times, serif;
    }

    --></style>
<div id="container">
    <div id="header"><a href="../index.php?q=logout">LOGOUT</a></div>
    <div id="main-body">

    </div>
    <div id="footer"></div>
</div>
<?php
include_once '../class.user.php';
$user = new User();
$uid = $user->getCurrentUid();
if (!$user->getSession($uid)) {
    header("location:login");
}
if (isset($_GET['q'])) {
    $user->userLogout();
    header("location:login");
}
?>