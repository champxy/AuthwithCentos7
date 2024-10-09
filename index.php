<?php
    include('connector.php');
    checklogin();
    groupban();
    kickice();
    makeshift();
    $dwn = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE attribute="WISPr-Bandwidth-Max-Down" AND groupname="'.$_SESSION['groupname'].'"'));
    $upl = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE attribute="WISPr-Bandwidth-Max-Up" AND groupname="'.$_SESSION['groupname'].'"'));
    $timo = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE attribute="Session-Timeout" AND groupname="'.$_SESSION['groupname'].'"'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>HOME</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST">
<div class="container">
    <div class="py-3">
        <div class="row">
            <div class="col-5">
            <div class="form-group">
              <label for="">ชื่อผู้ใช้</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="username" value="<?=$_SESSION['uid']?>" readonly>
            </div>
            </div>
            <div class="col-3">
            <?php include('userlog.php') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
            <div class="form-group">
              <label for="">ชื่อ - นามสกุล</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="fullname" value="<?=$_SESSION['fullname']?>" readonly>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
            <div class="form-group">
              <label for="">DownloadSpeed [Mb/s]</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="Max-Down" value="<?=number_format($dwn['value']/1048576)?>" readonly>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
            <div class="form-group">
              <label for="">UploadSpeed [Mb/s]</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="Max-Up" value="<?=number_format($upl['value']/1048576)?>" readonly>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
            <div class="form-group">
              <label for="">เวลาหมดอายุการใช้งาน [วินาที]</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="Max-Up" value="<?=$timo['value']?>" readonly>
            </div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<?php include('footer.php') ?>
</html>