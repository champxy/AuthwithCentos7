<?php
    include('connector.php');
    if(isset($_POST['txtUName'])){
        $username = $_POST['txtUName'];
        $values = $_POST['txtpw'];
        $fullname = $_POST['txtFull'];
        $check = mysqli_query($conn,'SELECT username FROM register WHERE username="'.$username.'"');
        $nums = mysqli_num_rows($check);
        if($nums==0){
            $SQL = 'INSERT INTO register (username,fullname,value) VALUES ("'.$username .'","'.$fullname.'","'.$values.'")';
            if(mysqli_query($conn,$SQL)==true){
                echo '<script>alert("สมัครสมาชิกสำเร็จ")</script>';
                echo '<script>location.replace("http://1.0.0.0")</script>';
            }else{
                echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถสมัครสมาชิกได้")</script>';
                echo '<script>location.replace("http://1.0.0.0")</script>';
            }
        }else{
            echo '<script>alert("ชื่อผู้ใช้นี้ถูกใช้งานแล้ว")</script>';
            echo '<script>location.replace("register.php")</script>'; 
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
<?php include("css.php") ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>REGISTER AUTHENTICATION</title>
</head>
<!-- Nav tabs -->
<ul class="nav nav-tabs">
        <h2 class="text-center"><a href="http://1.0.0.0" class="nav-link">LTC. Authentication</a></h2>
        <h5 class="ml-auto py-3 text-muted">สมัครสมาชิกเข้าใช้งานอินเทอร์เน็ต</h5>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div class="tab-pane fade show active" id="tab1Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab2Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab3Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab4Id" role="tabpanel"></div>
    <div class="tab-pane fade" id="tab5Id" role="tabpanel"></div>
</div>
<body>
 <form method="POST">
 <div class="container">
     <div class="row">
     <div class="col-7 py-5">
     <div class="col-5"></div>
     <div class="card">
        <div class="card-header">
             <h4 class="card-title">สมัครสมาชิกเข้าใช้งานอินเทอร์เน็ต  <i class="fa fa-id-card" aria-hidden="true"></i></h4>
         </div>
         <div class="card-body">
         <div class="form-group">
        <label for="">เลขบัตรประชาชน</label>
        <input type="number"
            class="form-control" name="txtUName" id="txtUName" aria-describedby="helpId" placeholder="username" require>
        <small id="helpId" class="form-text text-muted">เลขบัตรประชาชนจะใช้เป็น username เข้าใช้งาน</small>
   <hr>
   <label for="">ชื่อ - นามสกุล</label>
   <input type="text"
     class="form-control" name="txtFull" id="txtFull" aria-describedby="helpId" placeholder="Name" require>
   <label for="">รหัสผ่าน</label>
   <input type="password"
     class="form-control" name="txtpw" id="txtpw" aria-describedby="helpId" placeholder="Password" require>
     <hr>
     <small id="helpId" class="form-text text-muted">เมื่อลงทะเบียนเสร็จแล้ว กรุณารอการยืนยันจากแอดมิน</small>
     <button type="submit" class="btn btn-primary mt-2 w-100">ยืนยัน</button>
         </div>
     </div>
 </div>
     </div>
 </div>
 </div>
<div class="pb-5"></div>
<div class="pb-5"></div>
 </form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
<?php include('footer.php') ?>
</html>