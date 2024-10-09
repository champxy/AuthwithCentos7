<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $gr = mysqli_query($conn,'SELECT DISTINCT(groupname) FROM radgroupcheck WHERE groupname!="admins"');
    if(isset($_POST['save'])){
        $check = 'SELECT username FROM radcheck WHERE username="'.$_POST['username'].'"';
        $nums = mysqli_num_rows(mysqli_query($conn,$check));
        if($nums==0){
        if(is_uploaded_file($_FILES['pic']['tmp_name'])){
            $target_dir = "image/";
            $target_file = $target_dir . basename($_FILES['pic']['name']);
            move_uploaded_file($_FILES['pic']['tmp_name'],$target_file);
                $pic = $target_file;
                $lisa = 'INSERT INTO radcheck (username,attribute,op,value,fullname,pic) VALUE ("'.$_POST['username'].'","Cleartext-Password",":=","'.$_POST['values'].'","'.$_POST['fullname'].'","'.$pic.'")';
                $roses = 'INSERT INTO radusergroup (username,groupname,priority) VALUE ("'.$_POST['username'].'","'.$_POST['groupname'].'",1)';
        if((mysqli_query($conn,$lisa)==true)&&(mysqli_query($conn,$roses)==true)){
            echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
            echo '<script>location.replace("manageuser.php")</script>';
            
        }else{
            echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้")</script>';
            echo '<script>location.replace("manageuser.php")</script>';  
        }
        }
    }else{
        echo '<script>alert("มีชื่อผู้ใช้นี้ในระบบแล้ว")</script>';
        echo '<script>location.replace("manageuser.php")</script>';
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
                <h3>เพิ่มข้อมูลผู้ใช้</h3>
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
                    <hr>
                    <div class="form-group">
                      <label for="">กลุ่มผู้ใช้</label>
                      
                      <select class="form-control" name="groupname" id="groupname">
                      <?php 
                        while ($rs = mysqli_fetch_assoc($gr)){
                      ?>
                        <option value="<?=$rs['groupname']?>"><?=$rs['groupname']?></option>
                        <?php } ?>
                      </select>
                      <div class="col-md"><div class="form-inline"><div class="media">
                        <div class="media-body">
                            <p><br><input type="file" name="pic" id="pic"></p>
                        </div>
                    </div></div></div>
                    </div>
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