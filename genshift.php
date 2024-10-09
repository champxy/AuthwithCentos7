<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $gr = mysqli_query($conn,'SELECT DISTINCT(groupname) FROM radgroupcheck WHERE groupname!="admins" AND groupname!="Makeshift"');
    if(isset($_POST['save'])){
        if($_POST['count']<99){
        $check = 'SELECT username FROM radcheck WHERE username="'.$_POST['username'].'"';
        $nums = mysqli_num_rows(mysqli_query($conn,$check));
        if($nums==0){
            $x = 0;
            $k = $_POST['count'];
            while($k>$x){
                $x++;
                $name = $_POST['username'].$x;
                $k-1;
                $lisa = 'INSERT INTO radcheck (username,attribute,op,value,fullname,pic,stoptime) VALUE ("'.$name.'","Cleartext-Password",":="
                ,"'.$_POST['values'].'","'.$name.'","image/default.png","'.$_POST['shift'].':00")';
                $roses = 'INSERT INTO radusergroup (username,groupname,priority) VALUE ("'.$name.'","Makeshift",1)';
        if((mysqli_query($conn,$lisa)==true)&&(mysqli_query($conn,$roses)==true)){
            echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
            echo '<script>location.replace("manageshift.php")</script>';
        }else{
            echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้")</script>';
            echo '<script>location.replace("manageshift.php")</script>';
        }
            }
    }else{
        echo '<script>alert("มีชื่อผู้ใช้นี้ในระบบแล้ว")</script>';
        echo '<script>location.replace("manageshift.php")</script>';
}
    }else{
        echo '<script>alert("จำนวนที่userมากเกินไป")</script>';
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
<title>Generate User</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST" enctype="multipart/form-data">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-5 mt-3">
                <h3>เพิ่มข้อมูลผู้ใช้</h3>
                <div class="card mt-3">
                
                
                    <div class="card-body">
                    <div class="form-group">
                  <label for="">USERNAME</label>
                  <input type="text"
                    class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="username" required>
                    <label for="">รหัสผ่าน</label>
                  <input type="password"
                    class="form-control" name="values" id="values" aria-describedby="helpId" placeholder="รหัสผ่าน" required>
                    <label for="">จำนวนที่ต้องการ</label>
                  <input type="number"
                    class="form-control" name="count" id="count" aria-describedby="helpId" placeholder="จำนวน" required>
                    <small class="text-muted">เพิ่มผู้ใช้ครั้งได้ไม่เกิน 99 ID/ครั้ง</small><br>
                    <label for="">เวลาหมดอายุการใช้งาน</label>
                  <input type="datetime-local"
                    class="form-control" name="shift" id="shift" aria-describedby="helpId" placeholder="เวลาหมดอายุการใช้งาน" required>
                    <hr>
                    <h6 class="text-muted">ชื่อผู้ใช้จะเพิ่มอัตโนมัติ #guest1-guest99</h6>
                    <hr>
                    <a href="manageuser.php" class="btn btn-outline-danger">ยกเลิก</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modelIdSave">
                      บันทึก
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modelIdSave" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title text-white">ต้องการเพิ่มข้อมูล ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            เพิ่มข้อมูลผู้ใช้โดย Admin
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary" name="save" >ยืนยัน</button>
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