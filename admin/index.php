<?php
include_once '../php/send.php';
$userClass = new send();
if (!$userClass->isAdmin1() || (isset($_GET['q']) && $_GET['q'] == 'logout')) {
    $userClass->logoutUser();
    header("location:../../chatonline");
}
$allUsers = $userClass->getAllUsersForAdmin();
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-3.2.0/dist/css/bootstrap.css">
    <title>View Users</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;
    }

    .table {
        margin-top: 50px;

    }

</style>
<body>

<div class="table-scrol">
    <h1 align="center">All the Users</h1>
    <br>
    <a href="index.php?q=logout" style="float:right">Logout</a>


    <?php if (count($allUsers)) { ?>

        <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
            <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User full name</th>

                <th>Action</th>

            </tr>
            </thead>
            <?php foreach ($allUsers as $user) { ?>
                <tr>
                    <!--here showing results in the table -->
                    <td><?php echo $user[0]; ?></td>
                    <td><?php echo $user[1]; ?></td>
                    <td><?php echo $user[3]; ?></td>

                    <td>
                        <a href="delete.php?uid=<?= $user[0] ?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                        <a href="userchat/history/?uid=<?= $user[0] ?>">
                            <button class="btn btn-success">View User Chat History</button>
                        </a>
                    </td> <!--btn btn-danger is a bootstrap button to show danger-->
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <span>No users found....!!!</span>
    <?php } ?>
</div>
</div>


</body>

</html>

