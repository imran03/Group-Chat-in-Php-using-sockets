<?php
include_once('connection.php');
//include('sendAjaxHandler.php');
error_reporting(E_ALL && ~E_NOTICE);
class Send extends Model
{

    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function logoutUser()
    {
        $_SESSION = [];
    }

    public function msgUser($mid)
    {
        $sql = "SELECT * FROM messages WHERE messageId = $mid";
        $result = mysqli_query($this->db, $sql);
        $data = mysqli_fetch_array($result);
        if (!empty($data)) {
            return $data;
        }
        return false;
    }

    /*** for registration process ***/
    public function regUser($name, $username, $password)
    {
        if (!ctype_alnum($username))
            echo "Invalid UserName characters_";
        //if the username is not in db then insert to the table

        elseif (!$this->isUserExists($username)) {
            $sql1 = "INSERT INTO chat set fullname=('$name'),password=MD5('$password'), username='" . escapeshellcmd($username) . "', useronline='0',is_admin='0'";
//      print_r($sql1);die;
            $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot be inserted");
            return $result;
        } else {
            return false;
        }
    }

    public function isUserExists($username)
    {
        $sql = "SELECT uid FROM chat WHERE username='$username'";
        $check = $this->db->query($sql);
        if ($check && $check->num_rows > 0) {
            return true;
        }
        return false;
    }

    /*** for login process ***/

    public function checkLogin($emailusername, $password)
    {
        $sql = "SELECT * from chat WHERE (username='$emailusername') and password=MD5('$password')";

        //checking if the username is available in the table
        $result = mysqli_query($this->db, $sql);
        $data = mysqli_fetch_array($result);

        if (!ctype_alnum($emailusername))
            echo "Invalid characters_";

        elseif (!empty($data)) {
            $_SESSION['login'] = true;
            $_SESSION['uid'] = $data['uid'];
            $_SESSION['fullname'] = $data['fullname'];
            return $data;
        }
        return false;
    }

    /*** Admin check  ***/
    public function isAdmin1()
    {
        $user = $this->getUser($this->getCurrentUid());
        if ($user && $user['is_admin']) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($uid)
    {
        $sql = "SELECT * FROM chat WHERE uid = $uid";
        $result = mysqli_query($this->db, $sql);
        $data = mysqli_fetch_array($result);
        if (!empty($data)) {
            return $data;
        }
        return false;
    }

    public function getCurrentUid()
    {
        if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
            return $_SESSION['uid'];
        }
        return false;
    }

    public function removeChatHistory($mid)
    {
        if (mysqli_query($this->db, "DELETE FROM messages where messageId = $mid")) {
            return true;
        }
        return false;
    }


    //for deleting message history from admin page

    public function removeUser($uid)
    {
        if (mysqli_query($this->db, "DELETE FROM chat where uid = $uid")) {
            return true;
        }

        return false;
    }


//for deleting users from admin page

    public function removeUserAndMessages($uid)
    {
        if (mysqli_query($this->db, "DELETE FROM chat where uid = $uid")) {
            return true;
        }

        return false;
    }

    public function userChatHistory($uid)
    {
        $sql = "select m.messageId,m.msgRegisterDate,m.messageBody,c.fullname from messages as m, chat as c WHERE c.uid=m.messageSenderId and c.uid= $uid";
        $result = mysqli_query($this->db, $sql);
        $userData = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $userData;
    }

    //for displaying user chat history

    public function getAllUsersForAdmin()
    {
        if ($this->isAdmin()) {
            $sql = "SELECT * FROM chat where is_admin = 0";
            $result = mysqli_query($this->db, $sql);
            $userData = mysqli_fetch_all($result);
            return $userData;
        }
        return false;
    }


//Admin Dashboard

    /*** Admin check  ***/
    public function IsAdmin()
    {


        $sql2 = "SELECT uid from chat WHERE is_admin='1'";


        //checking if the username is available in the table
        $result = mysqli_query($this->db, $sql2);
        $user_data = mysqli_fetch_array($result);
        $count_row = $result->num_rows;


        if ($count_row == 1) {

            return true;
        } else {
            return false;
        }
    }


    //to display pivate users //
    public function privateUsers()
    {
        if ($this->isAdmin()) {
            $sql = "SELECT uid,username FROM chat where is_admin = 0";
            $result = mysqli_query($this->db, $sql);
            $userData = mysqli_fetch_all($result);
            return $userData;
        }
        return false;
    }



    public function process($message)
    {

        if ((!ctype_alnum($message))) {
            echo "<script>alert('invalid characters');</script>";
        }
            else{
        $date = date('Y-m-d H:i:s');
        $name = $_SESSION['fullname'] ?? 'user';
        $uid = $_SESSION['uid'] ?? 1;
        $sql = $this->db->query("INSERT INTO messages (msgRegisterDate,messageBody, messageSession,messageSenderId) VALUES ('$date', '$message', '" . $_SESSION['sesionName'] . "',$uid)");
    }
        //      print_r($sql1);die;
        if ($sql) {
            $dateTime = '<br><span>' . date('d M Y H:i:s', strtotime($date)) . '<span>';
            $array = array('name' => $name, 'message' => $message, 'sesion' => $_SESSION['sesionName'], 'dateTime' => $dateTime);
            return $array;
        }
    }



    public function load_messages()
    {
        $sql = $this->db->query("SELECT m.messageId,m.msgRegisterDate,m.messageBody,c.fullname,m.messageSenderId FROM messages as m, chat as c WHERE c.uid=m.messageSenderId ORDER BY msgRegisterDate");
        $html = '';
        $uid = $_SESSION['uid'] ?? 1;
        foreach ($sql as $key) {

            $name = $key['fullname'];
            $message = $key['messageBody'];
            $sendid = $key['messageSenderId'];
            $dateTime = date('d M Y H:i:s', strtotime($key['msgRegisterDate']));
            if($uid==$sendid){
                $html .= '<li class="meMessage"><label>' . $name . ': </label>' . $message . ' <br><span>' . $dateTime . '<span></li>';
            }
            else{
                $html .= '<li class="yourMessage"><label>' . $name . ': </label>' . $message . ' <br><span>' . $dateTime . '<span></li>';
            }

        }
        return trim($html);
    }
///For private messages and inserting chat

    public function privateMsg($message)
    {

        if ((!ctype_alnum($message))) {
            echo "<script>alert('invalid characters');</script>";
        }
        else{
            $date = date('Y-m-d H:i:s');
            $name = $_SESSION['fullname'] ?? 'user';
            $uid = $_SESSION['uid'] ?? 1;
            $recid = $_POST['mrid'];
//            $sql = $this->db->query("INSERT INTO privatechat (created_time,message_text,sender_id,receiver_id) VALUES ('$date', '$message', '$uid','10')");
//            INSERT INTO privatechat (message_text,sender_id,receiver_id) VALUES ('hai', '13','10')
            $sql = $this->db->query("INSERT INTO privatechat (created_time,message_text,sender_id,receiver_id) VALUES ('$date', '$message', '$uid','$recid)");
        }

        if ($sql) {
            $dateTime = '<br><span>' . date('d M Y H:i:s', strtotime($date)) . '<span>';
            $array = array('pname' => $name, 'pmessage' => $message, 'sesion' => $_SESSION['sesionName'], 'dateTime' => $dateTime);
            return $array;
        }
    }




    public function loadPrivateMessages($recid)


    {
//var_dump($recid);die;
            $sql = $this->db->query("SELECT sender_id, message_text, created_time FROM privatechat
WHERE receiver_id = $recid
ORDER BY created_time DESC");

            $html = '';
//        if($sql) {
//            $array=array('mrid'=>$recid);
//            return $array;
//        }

        foreach ($sql as $key) {
//            $uid = $_SESSION['uid'] ?? 1;
//            $name = $key['fullname'];
            $name = $_SESSION['fullname'] ?? 'user';
            $message = $key['message_text'];
            $sendid = $key['sender_id'];
            $dateTime = date('d M Y H:i:s', strtotime($key['created_time']));

            if($uid==$sendid){
                $html .= '<li class="meMessage"><label>' . $name . ': </label>' . $message . ' <br><span>' . $dateTime . '<span></li>';
            }
            else{
                $html .= '<li class="yourMessage"><label>' . $name . ': </label>' . $message . ' <br><span>' . $dateTime . '<span></li>';
            }

        }
        return trim($html,$recid);
    }

}

if (isset($_POST['name']) AND isset($_POST['message'])) {
    $message = $_POST['message'];
    $class = new Send();
    $process = $class->process($message);
    exit(json_encode($process));
}

if (isset($_POST['pname']) AND isset($_POST['pmessage'])) {
    $message = $_POST['pmessage'];
    $class = new Send();
    $process = $class->privateMsg($message);
    exit(json_encode($process));
}

if (isset ($_POST['mrid'])){
    $recid = $_POST['mrid'];
    $class=new Send();
    $process = $class->loadPrivateMessages($recid);
    exit (json_encode($process));
}