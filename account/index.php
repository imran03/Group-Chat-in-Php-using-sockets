<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/5/18
 * Time: 4:25 PM
 */
include "validate.php";


include_once '../php/send.php';
session_start();
$user = new Send();

if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $login = $user->checkLogin($emailusername, $password);

    if (!$login) {
        echo 'Invaid login details  ';
    } else {
        header("Location: ../../../chatonline");
    }
}
?>





<html xmlns="">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<link rel="stylesheet" href="../css/login.css">

<script language="JavaScript" type="text/javascript"  src="../js/login.js"></script>

<div class="materialContainer">

    <form action="" method="post" name="login">
   <div class="box">

      <div class="title">LOGIN</div>

      <div class="input">
         <label for="name">Username</label>
         <input type="text" name="emailusername" id="name">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="pass">Password</label>
         <input type="password" name="password" id="pass">
         <span class="spin"></span>
      </div>

      <div class="button">
<!--          <input onclick="return(submitlogin());" type="submit" name="submit" value="Login"/>-->
          <button type="submit" name="submit" onclick="return(submitlogin());">Login  <i class="fa fa-check"></i></button>

      </div>



   </div>
    </form>
    <form action="" method="post" name="reg">
   <div class="overbox">
      <div class="material-button alt-2"><span class="shape"></span></div>

      <div class="title">REGISTER</div>

       <div class="input">
           <label for="fname">Full Name</label>
           <input type="text" name="fullname1" id="fname">
           <span class="spin"></span>
       </div>
      <div class="input">
         <label for="regname">User Name</label>
         <input type="text" name="username1" id="regname">
         <span class="spin"></span>
      </div>

      <div class="input">
         <label for="regpass">Password</label>
         <input type="password" name="password1" id="regpass">
         <span class="spin"></span>
      </div>



      <div class="button">
         <button type="button" onclick="submitreg()"><span>Register</span></button>
      </div>


   </div>
    </form>

</div>

</html>

