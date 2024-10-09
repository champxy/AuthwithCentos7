<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $SE1 = mysqli_fetch_assoc(mysqli_query($conn,'SELECT groupname,value FROM radgroupcheck WHERE groupname="'.$_GET['groupname'].'" AND attribute="Simultaneous-Use"'));
    $SE2 = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE groupname="'.$_GET['groupname'].'" AND attribute="WISPr-Bandwidth-Max-Down"'));
    $SE3 = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE groupname="'.$_GET['groupname'].'" AND attribute="WISPr-Bandwidth-Max-Up"'));
    $SE4 = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply WHERE groupname="'.$_GET['groupname'].'" AND attribute="Session-Timeout"'));
    if(isset($_POST['save'])){
        $download = $_POST['download']*1048576;
        $upload = $_POST['upload']*1048576;
        $update1 = 'UPDATE radgroupcheck SET value='.$_POST['count'].' WHERE groupname ="'.$_GET['groupname'].'" AND attribute="Simultaneous-Use"';
        $update2 = 'UPDATE radgroupreply SET value='.$download.' WHERE groupname ="'.$_GET['groupname'].'" AND attribute="WISPr-Bandwidth-Max-Down"';
        $update3 = 'UPDATE radgroupreply SET value='.$upload.' WHERE groupname ="'.$_GET['groupname'].'" AND attribute="WISPr-Bandwidth-Max-Up"';
        $update4 = 'UPDATE radgroupreply SET value='.$_POST['timeout'].' WHERE groupname ="'.$_GET['groupname'].'" AND attribute="Session-Timeout"';
        if((mysqli_query($conn,$update1)==true)&&(mysqli_query($conn,$update2)==true)&&(mysqli_query($conn,$update3)==true)&&(mysqli_query($conn,$update4)==true)){
            echo '<script>alert("อัพเดทข้อมูลสำเร็จ")</script>';
            echo '<script>location.replace("managegroup.php")</script>';
        }else{
            echo '<script>alert("ไม่สามารถอัพเดทข้อมูลได้")</script>';
            echo '<script>location.replace("managegroup.php")</script>';
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
<?php include('css.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Group Management</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-5 mt-3">
                <h3>แก้ไขกลุ่มผู้ใช้</h3>
                <div class="card mt-3">
                    <div class="card-body">
                    <div class="form-group ">
                  <label for="">ชื่อกลุ่ม</label>
                  <input type="text"
                    class="form-control" name="groupname" id="groupname" aria-describedby="helpId" placeholder="username" value="<?=$SE1['groupname']?>" readonly>
                    <hr>
                    <label for="">Download Speed [Mb/s]</label>
                  <input type="text"
                    class="form-control" name="download" id="download" aria-describedby="helpId" placeholder="Download Speed [Mb/s]" value="<?=number_format(($SE2['value']/1048576))?>">
                    <label for="">Upload Speed [Mb/s]</label>
                  <input type="text"
                    class="form-control" name="upload" id="upload" aria-describedby="helpId" placeholder="Upload Speed [Mb/s]" value="<?=number_format(($SE3['value']/1048576))?>">
                    <hr>
                    <label for="">จำนวนผู้ใช้ [ต่อ IP]</label>
                  <input type="text"
                    class="form-control" name="count" id="count" aria-describedby="helpId" placeholder="จำนวนผู้ใช้" value="<?=$SE1['value']?>">
                    <label for="">เวลาใช้งาน [วินาที]</label>
                  <input type="text"
                    class="form-control" name="timeout" id="timeout" aria-describedby="helpId" placeholder="timeout" value="<?=$SE4['value']?>">
                    <hr>
                    <a href="managegroup.php" class="btn btn-outline-danger">ยกเลิก</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modelIdSave<?=$SE1['groupname']?>">
                      บันทึก
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelIdSave<?=$SE1['groupname']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h5 class="modal-title text-white">ต้องการอัพเดทข้อมูล ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    อัพเดทข้อมูลของกลุ่มผู้ใช้ : <?=$SE1['groupname']?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                    <button type="save" class="btn btn-success" name="save" value="<?=$SE1['groupname']?>">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5"></div>
<div class="pb-5"></div>
<div class="pb-5"></div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<?php include('footer.php') ?>
</html>