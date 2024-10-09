<?php
    include('connector.php');
    $rs = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM radacct WHERE username="'.$_SESSION['uid'].'"'));
    $exlog = explode(' ',$rs['acctstarttime']);
    $login = strtotime($exlog[1]);
    $nows = strtotime(date('H:i:s'));
    $exchange = $nows-$login;
    $came = date($exchange/60);
    $distance = date('H:i:s',$exchange);
    $vvs = explode('.',$rs['framedipaddress']);
    $vlan = $vvs[2];
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
<title>My infomation</title>
</head>
<?php include('nav.php') ?>
<body>
<div class="container">
<div class="py-2">
    <div class="row">
        <div class="col-5">
            <div class="form-group">
              <label for="">ชื่อผู้ใช้งาน</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="" value="<?=$rs["username"]?>" readonly>
            </div>
        </div>
        <div class="col-3">
            <?php include('userlog.php') ?>
            </div>
    </div>

    <div class="row">
        <div class="col-5">
            <div class="form-group">
              <label for="">เวลาเข้าสู่ระบบ</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="" value="<?php echo $rs['acctstarttime']?>
                   " readonly>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-5">
            <div class="form-group">
              <label for="">เวลาออนไลน์ในระบบ</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="" value="<?php if($came>=60){
      echo number_format($came/60)," ชั่วโมง ";
      echo number_format($came%60)," นาที ";
    }else{
    echo $came," นาที";
    }?>
                   " readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-5">
            <div class="form-group">
              <label for="">VLAN STAY</label>
              <input type="text"
                class="form-control" aria-describedby="helpId" placeholder="" value="<?=$vlan?>" readonly>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<?php include('footer.php') ?>
</html>