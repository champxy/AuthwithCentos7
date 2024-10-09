<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $con = null;
    if(isset($_POST['tmp'])){
        $con = ' AND username LIKE "%'.$_POST['tmp'].'%"';
    }
    $SQL = mysqli_query($conn,'SELECT * FROM radacct WHERE 1=1'.$con);
    if(isset($_POST['Clear'])){
        $del = 'DELETE FROM radacct';
        if(mysqli_query($conn,$del)==true){
            echo '<script>alert("ลบข้อมูลทั้งหมดแล้ว")</script>';
            echo '<script>location.replace("manageonline.php")</script>';
        }
    }
    if(isset($_POST['kick'])){
        $theUser = $_POST['username'];
        #$nasaddr = $_POST['nasaddr'];
        #$sharedsecret = $_POST['nassecret'];
        #$coaport = $_POST['coaport'];
        $updateSQL = 'UPDATE radacct SET acctterminatecause ="Admin-Reset" , acctstoptime = now() WHERE username ="'.$theUser.'" AND acctstoptime IS NULL';
        #mysqli_query($conn,$updateSQL);
        #$result = disconnect_user($theUser,$nasaddr,$coaport,$sharedsecret);
        if(mysqli_query($conn,$updateSQL)==true){
            echo '<script>alert("ยกเลิกผู้ใช้งานชั่วคราวแล้ว")</script>';
            echo '<script>location.replace("manageonline.php")</script>';
        }
    }
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
<title>Online Management</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST">

    <div class="py-2">
        <div class="row">
            <div class="col-9">
            <div class="form-group form-inline">
              <input type="text"
                class="form-control" name="tmp" id="tmp" aria-describedby="helpId" placeholder="ค้นหาโดยใช้ชื่อผู้ใช้">
                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger ml-2" data-toggle="modal" data-target="#modelIdClear">
                  Clear All
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modelIdClear" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ต้องการลบข้อมูลทั้งหมด ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                ประวัติการเข้าใช้งานทั้งหมดจะถูกลบ
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                <button type="button" class="btn btn-primary" name="Clear">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>เวลาเข้าใช้งาน</th>
                            <th>เวลาออกจากระบบ</th>
                            <th>เวลาออนไลน์</th>
                            <th>IP Address</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; while($rs=mysqli_fetch_assoc($SQL)){
                        $i++;
                        $login = strtotime($rs['acctstarttime']);
                        $logout = strtotime($rs['acctstoptime']);
                        $exdis = $logout-$login;
                        $distance = date('H:i:s',$exdis);
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$rs['username']?></td>
                            <td><?=$rs['acctstarttime']?></td>
                            <td><?php if($rs['acctstoptime']==0){
                                echo '<h6 class="text-success">กำลังออนไลน์</h6>';
                            }else{
                                echo $rs['acctstoptime'];
                            }
                            ?></td>
                            <td><?=$distance?></td>
                            <td><?=$rs['framedipaddress']?></td>
                            <?php if($rs['acctstoptime']==0){ ?>
                            <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelId<?=$rs['username']?>">
                              Disconnect
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modelId<?=$rs['username']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-white">ต้องการยกเลิกผู้ใช้งานชั่วคราว ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            ต้องการยกเลิกผู้ใช้งานชั่วคราว Username : <?=$rs['username']?>
                                            <input type="hidden" id="username" name="username" value="<?=$rs['username']?>">
                                            <input type="hidden" id="nasaddr" name="nasaddr" value="127.0.0.1">
                                            <input type="hidden" id="nassecret" name="nassecret" value="test123">
                                            <input type="hidden" id="coaport" name="coaport" value="3379">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-danger" name="kick">ยืนยัน</button>
                                        </div>
                                    </div>
                                </div>
                            </div></td><?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-1">
            <?php include('userlog.php') ?>
            </div>
        </div>
    </div>
    <div class="pb-5"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</form>
</body>
<?php include('footer.php') ?>
</html>