<?php

include_once '../../php/send.php';
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
    <div>
        <link type="text/css" rel="stylesheet" href="../../css/bootstrap-3.2.0/dist/css/bootstrap.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            #container {
                width: 400px;
                margin: 0 auto;
            }
        </style>

        <script type="text/javascript" language="javascript">

            function submitlogin() {
                var form = document.login;
                if (form.emailusername.value == "") {
                    alert("Enter email or username.");
                    return false;
                }
                else if (form.password.value == "") {
                    alert("Enter password.");
                    return false;
                }
            }

        </script>

        <span style="font-family: 'Courier 10 Pitch', Courier, monospace; font-size: 13px; font-style: normal; line-height: 1.5;"><div
                    id="container"></span>
        <h1>Login Here</h1>
        <form action="" method="post" name="login">
            <table>
                <tbody>
                <tr>
                    <th>UserName:</th>
                    <td><input type="text" name="emailusername" required=""/></td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td><input type="password" name="password" required=""/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input onclick="return(submitlogin());" type="submit" name="submit" value="Login"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="accounts/registration">Register new user</a></td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    </html>
<?php exit; ?>