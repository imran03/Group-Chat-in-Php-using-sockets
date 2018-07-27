<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 9/5/18
 * Time: 4:25 PM
 */?>

<script type="text/javascript" language="javascript">

    function submitlogin() {
        var form = document.login;
        if (form.uname.value == "") {
            alert("Enter username.");
            return false;
        }
        else if (form.pass.value == "") {
            alert("Enter password.");
            return false;
        }
    }

</script>

<script type="text/javascript" language="javascript">
    function submitreg() {
        var form = document.reg;
        if(form.fullname1.value == ""){
            alert( "Enter name." );
            return false;
        }
        else if(form.username1.value == ""){
            alert( "Enter username." );
            return false;
        }



        else if(form.password1.value == ""){
            alert( "Enter password." );
            return false;
        }

    }
</script>
