<?php
    session_start();
    date_default_timezone_set('Asia/Bangkok');
    $conn = mysqli_connect('localhost','root','','radius');
    mysqli_set_charset($conn,'UTF8');

    function checklogin() {
        if(!$_SESSION['uid']){
            echo '<script>alert("กรุณาเข้าสู่ระบบ")</script>';
            echo '<script>location.replace("http://1.0.0.0")</script>';
        }
    }

    function checkgroup() {
        if($_SESSION['groupname']!='admins'){
            echo '<script>alert("กรุณาเข้าสู่ระบบ")</script>';
            echo '<script>location.replace("http://1.0.0.0")</script>';
        }
    }

    function groupban() {
        if($_SESSION['groupname']=='Ban'){
            echo '<script>alert("ผู้ใช้นี้ถูกระงับการใช้งาน")</script>';
            echo '<script>location.replace("http://1.0.0.0")</script>';
        }
    }

    /**function disconnect_user($theUser,$nasaddr,$coaport,$sharedsecret){
        $command = "echo\"User-name = $theUser\"|radclient -x $nasaddr : $coaport disconnect $sharedsecret";
        $result = '$command';
        $output = "<b>Command</b>:$command<br /><b>Output:</b><br />".nl2br($result)."<br />";
    }**/

    function kickice(){
        $conn = mysqli_connect('localhost','root','','radius');
        $SQL = mysqli_query($conn,'SELECT acctterminatecause FROM radacct WHERE acctterminatecause="Admin-Reset" AND username="'.$_SESSION['uid'].'"');
        $nums = mysqli_num_rows($SQL);
            if($nums!=0){
                $dis = mysqli_fetch_assoc($SQL);
                echo '<script>alert("คุณโดนเตะออกจากระบบ")</script>';
                echo '<script>location.replace("logout.php")</script>';
            }
        }

    function makeshift() {
        if($_SESSION['groupname']=='Makeshift'){
            $conn = mysqli_connect('localhost','root','','radius');
            $SQL = mysqli_fetch_assoc(mysqli_query($conn,'SELECT radcheck.*,radusergroup.groupname FROM radcheck,radusergroup WHERE radcheck.username=radusergroup.username 
            AND radusergroup.groupname="Makeshift" AND radcheck.username="'.$_SESSION['uid'].'"'));
            $nows = strtotime(date('d-M-Y H:i:s'));
            $times = strtotime($SQL['stoptime']);
            if($times<=$nows){
                mysqli_query($conn,'DELETE radcheck.*,radusergroup.* FROM radcheck,radusergroup WHERE radcheck.username="'.$_SESSION['uid'].'" 
                AND radusergroup.username="'.$_SESSION['uid'].'"');
                echo '<script>alert("หมดเวลาการใช้งาน")</script>';
                echo '<script>location.replace("http://1.0.0.0")</script>';
            }
        }
    }
?>