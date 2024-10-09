<?php
    include('connector.php');
    checklogin();
    groupban();
    $gr = mysqli_query($conn,'SELECT DISTINCT(groupname) FROM radgroupcheck WHERE groupname!="admins"');
    if(isset($_POST['Save'])){
        $check = mysqli_query($conn,'SELECT username FROM radcheck WHERE username="'.$_POST['username'].'"');
        $nums = mysqli_num_rows($check);
        if($nums==0){
            if(!empty($_FILES['pic'])){
                if(is_uploaded_file($_FILES['pic']['tmp_name'])){
                    $target_dir = "image/";
                    $target_file = $target_dir . basename($_FILES['pic']['name']);
                    move_uploaded_file($_FILES['pic']['tmp_name'],$target_file);
                    $pic = $target_file;
                    $lisa = 'INSERT INTO radcheck (username,fullname,attribute,value,op,pic,stoptime) VALUES ("'.$_POST['username'].'","'.$_POST['fullname'].'","Cleartext-Password","'.$_POST['values'].'",":=","'.$pic.'","'.$_POST['shift'].':00")';
                    $roses = 'INSERT INTO radusergroup (username,groupname,priority) VALUES ("'.$_POST['username'].'","Makeshift",1)';
            }
            if((mysqli_query($conn,$lisa)==true)&&(mysqli_query($conn,$roses)==true)){
                echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
                echo '<script>location.replace("manageshift.php")</script>'; 
            }else{
                echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้")</script>';
                echo '<script>location.replace("manageshift.php")</script>';
            }
        }
        }else{
            echo '<script>alert("ชื่อผู้ใช้นี้ถูกใช้งานแล้ว")</script>';
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
<?php include('css.php')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>INSERT USER</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST" enctype="multipart/form-data">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-5 mt-3">
                <h3>เพิ่มข้อมูลผู้ใช้ชั่วคราว</h3>
                <div class="card mt-3">
                    <div class="card-body">
                    <div class="form-group">
                  <label for="">USERNAME</label>
                  <input type="text"
                    class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="username" required>
                    <hr>
                    <label for="">ชื่อ-นามสกุล</label>
                  <input type="text"
                    class="form-control" name="fullname" id="fullname" aria-describedby="helpId" placeholder="ชื่อ-นามสกุล" required>
                    <label for="">รหัสผ่าน</label>
                  <input type="password"
                    class="form-control" name="values" id="values" aria-describedby="helpId" placeholder="รหัสผ่าน" required>
                    <label for="">เวลาหมดอายุการใช้งาน</label>
                  <input type="datetime-local"
                    class="form-control" name="shift" id="shift" aria-describedby="helpId" placeholder="เวลาหมดอายุการใช้งาน" required>
                    <hr>
                      <div class="col-md"><div class="form-inline"><div class="media">
                        <div class="media-body">
                            <p><br><input type="file" name="pic" id="pic" required></p>
                        </div>
                    </div></div></div>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-outline-danger">ยกเลิก</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelIdSave">
                      ยืนยัน
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modelIdSave" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ต้องการเพิ่มข้อมูลผู้ใช้ ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    เพิ่มข้อมูลผู้ใช้โดยแอดมิน
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-success" name="Save" id="Save">บันทึก</button>
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