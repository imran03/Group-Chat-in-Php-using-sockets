<?php
/**
 * Created by PhpStorm.
 * User: imran
 * Date: 22/5/18
 * Time: 5:43 PM
 */

include_once '../../../php/send.php';
$userClass = new send();
if (!$userClass->isAdmin1()) {
    header("location:../../../../chatonline");
}
$uid = $_GET['uid'];
$user = $userClass->getUser($uid);
$history = $userClass->userChatHistory($uid);
if ($userClass->isAdmin() && $user) {
    ?>
    <a href="../../">Back</a><br>
    <?php if (count($history)) {
        ?>
        <html>
        <head lang="en">
            <meta charset="UTF-8">
            <link type="text/css" rel="stylesheet" href="../../../css/bootstrap-3.2.0/dist/css/bootstrap.css">
            <title>Chat History</title>
        </head>
        <body>
        <div style="text-align: center">
            <h2>Chat History for <b><?= $user['fullname'] ?></b></h2>
        </div>
        <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
            <thead>
            <tr>

                <th>Message Date</th>
                <th>Messages</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php foreach ($history as $data) { ?>
                <tr>

                    <td><?php echo $data['msgRegisterDate']; ?></td>
                    <td><?php echo $data['messageBody']; ?></td>
                        <td>
                            <a href="delete.php?uid=<?= $user[0] ?>&msgId=<?=$data['messageId']?>">
                                <button class="btn btn-danger">Delete</button>
                            </a>
                        </td>
                </tr>
            <?php } ?>
        </table>
        </body>
        </html>

        <?php
    } else {
        ?>
        <span>No chat history found for user <b><?= $user['fullname'] ?></b> !!!</span>
        <?php
    }
    ?>
    <?php
} else {
    header("location:../../../");
}
?>
