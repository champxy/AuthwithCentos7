<?php
    include('connector.php');
    $uid = $_GET['uid'];
    $SQL = mysqli_query($conn,'SELECT radcheck.*,radusergroup.groupname FROM radcheck,radusergroup WHERE radcheck.username=radusergroup.username
    AND radcheck.attribute="Cleartext-Password" AND radcheck.username="'.$uid.'"');
    $nums = mysqli_num_rows($SQL);
    if($nums!=0){
        $rs = mysqli_fetch_assoc($SQL);
        $_SESSION['uid']=$rs['username'];
        $_SESSION['groupname']=$rs['groupname'];
        $_SESSION['timeout']=date('d-M-Y H:i:s');
        $_SESSION['pic']=$rs['pic'];
        $_SESSION['fullname']=$rs['fullname'];
        echo '<script>alert("เข้าสู่ระบบสำเร็จ")</script>';
        echo '<script>location.replace("index.php")</script>';
    }else{
        echo '<script>alert("ไม่พบชื่อผู้ใช้นี้")</script>';
        echo '<script>location.replace("http://1.0.0.0")</script>';
    }
?> 