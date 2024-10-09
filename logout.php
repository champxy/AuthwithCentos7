<?php
    session_start();
    session_destroy();
    echo '<script>alert("ออกจากระบบ")</script>';
    echo '<script>location.replace("http://1.0.0.0")</script>';
?>