<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $ur = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM radcheck WHERE username="'.$_GET['username'].'"'));
    $gr = mysqli_query($conn,'SELECT DISTINCT(groupname) FROM radgroupcheck WHERE groupname!="admins" ORDER BY groupname="Makeshift" DESC');
    if(isset($_POST['save'])){
        if(!empty($_FILES['pic'])){
            if(is_uploaded_file($_FILES['pic']['tmp_name'])){
                $target_dir = "image/";
                $target_file = $target_dir . basename($_FILES['pic']['name']);
                move_uploaded_file($_FILES['pic']['tmp_name'],$target_file);
                $pic = $target_file;
                $lisa = 'UPDATE radcheck SET fullname="'.$_POST['fullname'].'",value="'.$_POST['values'].'",pic="'.$pic.'",stoptime="'.$_POST['shift'].':00" WHERE username="'.$_GET['username'].'"';
                $roses = 'UPDATE radusergroup SET groupname="'.$_POST['groupname'].'" WHERE username="'.$_GET['username'].'"';
        }else{
                
                $lisa = 'UPDATE radcheck SET fullname="'.$_POST['fullname'].'",value="'.$_POST['values'].'",stoptime="'.$_POST['shift'].':00" WHERE username="'.$_GET['username'].'"';
                $roses = 'UPDATE radusergroup SET groupname="'.$_POST['groupname'].'" WHERE username="'.$_GET['username'].'"';
                echo $lisa;
        }
        if((mysqli_query($conn,$lisa)==true)&&(mysqli_query($conn,$roses)==true)){
            echo '<script>alert("อัพเดทข้อมูลสำเร็จ")</script>';
            echo '<script>location.replace("manageshift.php")</script>';
        }else{
            echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถอัพเดทข้อมูลได้")</script>';
            #echo '<script>location.replace("manageshift.php")</script>';
        }
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
<title>UPDATE USER</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST" enctype="multipart/form-data">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-5 mt-3">
                <h3>แก้ไขผู้ใช้</h3>
                <div class="card mt-3">
                
                
                    <div class="card-body">
                    <div class="form-group">
                  <label for="">USERNAME</label>
                  <input type="text"
                    class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="username" value="<?=$ur['username']?>" readonly>
                    <hr>
                    <label for="">ชื่อ-นามสกุล</label>
                  <input type="text"
                    class="form-control" name="fullname" id="fullname" aria-describedby="helpId" placeholder="ชื่อ-นามสกุล" value="<?=$ur['fullname']?>">
                    <label for="">รหัสผ่าน</label>
                  <input type="password"
                    class="form-control" name="values" id="values" aria-describedby="helpId" placeholder="รหัสผ่าน" value="<?=$ur['value']?>">
                    <label for="">เวลาหมดอายุการใช้งาน</label>
                  <input type="datetime-local"
                    class="form-control" name="shift" id="shift" aria-describedby="helpId" placeholder="เวลาหมดอายุการใช้งาน" required>
                    <small class="text-muted"><?=$ur['stoptime']?></small>
                    <div class="form-group">
                      <label for="">กลุ่ม</label>
                      <select class="form-control" name="groupname" id="groupname">
                      <?php 
                      while($rs=mysqli_fetch_assoc($gr)){
                      ?>
                        <option><?=$rs['groupname']?></option>
                    <?php } ?>
                      </select>
                    </div>
                    <hr>
                    <div class="form-inline">
                    <img src="<?=$ur['pic']?>" class="img-fluid" style="width:25%">
                    <input type="file" name="pic" id="pic" class="mb-2"><br>
                    </div>
                    <a href="manageshift.php" class="btn btn-outline-danger">ยกเลิก</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modelIdSave<?=$ur['username']?>">
                      บันทึก
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelIdSave<?=$ur['username']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">ต้องการอัพเดทข้อมูล ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            username : <?=$ur['username']?><br>
                            ชื่อ - นามสกุล : <?=$ur['fullname']?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" name="save" id="save" value="<?=$ur['username']?>">ยืนยัน</button>
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