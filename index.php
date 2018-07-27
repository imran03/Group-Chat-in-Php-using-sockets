<?php
include_once('php/config.php');
include_once('php/device.php');
include_once('php/send.php');
$class = new Send();

$isadmin = $class->isAdmin1();
if ($isadmin)
    header("Location:admin");

if ((!isset($_SESSION['login']) && !isset($_SESSION['uid'])) || $_REQUEST['logout']) {

    include_once('accounts/login/index.php');
}

//$userClass = new send();
//if (!$userClass->isAdmin1() || (isset($_GET['q']) && $_GET['q'] == 'logout')) {
//    $userClass->logoutUser();
//    header("location:../../chatonline");
//}
//$allUsers = $isadmin->privateUsers();

?>
<?php
$userClass = new send();
//if (!$userClass->isAdmin1() || (isset($_GET['q']) && $_GET['q'] == 'logout')) {
//    $userClass->logoutUser();
//    header("location:../../chatonline");
//}
$allUsers = $userClass->privateUsers();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Chat Online</title>
    <meta charset="UTF-8">
    <?php
    if ($tablet_browser > 0) {
        echo '<link rel="stylesheet" type="text/css" href="' . URL_BASE . 'css/stylesMobile.css">';
    } else if ($mobile_browser > 0) {
        echo '<link rel="stylesheet" type="text/css" href="' . URL_BASE . 'css/stylesMobile.css">';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="' . URL_BASE . 'css/styles.css">';
    }
    ?>
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link type="text/css" rel="stylesheet" href="css/bootstrap-3.2.0/dist/css/bootstrap.css">

    <link rel="stylesheet" href="css/leftsidebar.css">

    <script type="text/javascript">
        var urlPort = '<?=SOCKET_FRONTEND;?>';
    </script>
    <script src="<?= URL_BASE; ?>js/jquery.js" type="text/javascript"></script>
    <script src="<?= URL_BASE; ?>js/fancywebsocket.js"></script>
    <script src="<?= URL_BASE; ?>js/groupChat.js" type="text/javascript"></script>
    <script src="<?= URL_BASE; ?>js/leftsidebar.js" type="text/javascript"></script>
    <script src="<?= URL_BASE; ?>js/private.js" type="text/javascript"></script>
    <script src="<?= URL_BASE; ?>js/AjaxUsers.js" type="text/javascript"></script>


</head>
<body>


<div id="wrapper">
    <div class="sidenav col-lg-4">
        <?php if (count($allUsers)) {
            foreach ($allUsers as $user):?>

                <a>

                    <button class="custom-buttons" id="btn"
                            onclick="ajax('<?= $user[0] ?>') ,showPrivateMessages(),showPrivateBox(),document.getElementById('userName').innerText='<?php echo $user[1]; ?>'"
                            value="<?php echo $user[0]; ?>"><?php echo $user[1]; ?></button>

                <a/>
            <?php endforeach;
        }
        ?>


    </div>

    <div class="main col-lg-8">

        <div id="header">
           <span id="userName" style="color:#424242;"></span>  <?php echo $_SESSION[''] ?>
            <a class="logout-button" href="?logout=1">
                <button class="bg-primary">Logout</button>
            </a>
        </div>


        <div id="content">
            <ul id="containerMessages"><?= $class->load_messages(); ?></ul>
            <ul id="containerMessagesPrivate" class="hideOrShow"><?= $class->loadPrivateMessages($recid); ?></ul>

        </div>

        <div id="footer">
            <form id="formChat" type="chat">
                <table>
                    <div id="type_id" style="text-align: center"></div>
                    <tr>
                        <!--<td width="90%"><input type="text" placeholder="Enter your name" id="name" autofocus autocomplete="off"></td>-->

                        <td width="auto" class="publicMessageInput"><input type="text" data-validation="alphanumeric"
                                                                           data-validation-allowing="_"
                                                                           placeholder="Enter your text message.."
                                                                           id="message"
                                                                           autocomplete="off"></td>
                        <!--                        onkeyup="return validation();"-->
                        <td class="publicMessageInput"><input type="submit" value="sent" id="submit"></td>

                    </tr>
                </table>
            </form>

            <form id="privateChat" type="pchat">
                <table>
                    <div id="type_id" style="text-align: center"></div>
                    <tr>
                        <!--<td width="90%"><input type="text" placeholder="Enter your name" id="name" autofocus autocomplete="off"></td>-->

                        <td width="auto" class="publicMessageInput"><input type="text" data-validation="alphanumeric"
                                                                           data-validation-allowing="_"
                                                                           placeholder="Enter your text message.."
                                                                           id="pmessage"
                                                                           autocomplete="off"></td>
                        <!--                        onkeyup="return validation();"-->
                        <td class="publicMessageInput"><input type="submit" value="sent" id="submit"></td>

                    </tr>
                </table>
            </form>


        </div>

    </div>


</div>

<script type="text/javascript">
    var height = $('body').prop('scrollHeight');
    $('html, body').animate({scrollTop: height}, 600);
    document.getElementById('containerMessagesPrivate');

    function showPrivateMessages() {
        var domElement = document.getElementById('containerMessages');
        domElement.style.display = 'none';


        var domElement = document.getElementById('containerMessagesPrivate');
        domElement.style.display = 'block';


    }
</script>


<script type="text/javascript">
    var height = $('body').prop('scrollHeight');
    $('html, body').animate({scrollTop: height}, 600);

    // document.getElementById('containerMessagesPrivate');

    function showPrivateBox() {
        var domElement = document.getElementById('formChat');
        domElement.style.display = 'none';


        var domElement = document.getElementById('privateChat');
        domElement.style.display = 'block';
    }
</script>





</body>
</html>