<?php
    include('connector.php');
    if(isset($_POST['txtUName'])){
        $SQL = mysqli_fetch_assoc(mysqli_query($conn,'SELECT * FROM radcheck WHERE username="'.$_POST['txtUName'].'" AND value="'.$_POST['txtpw'].'"'));
        if($SQL==true){
            header('location:checklogin.php?uid='.$SQL['username']);
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
<title>LOGIN</title>
</head>
<body>
<form method="POST">
<div class="container">
    <div class="row">
    <div class="form-group">
      <label for="">USERNAME</label>
      <input type="text"
        class="form-control" name="txtUName" id="txtUName" aria-describedby="helpId" placeholder="ชื่อผู้ใช้" require>
      <label for="">PASSWORD</label>
      <input type="text"
        class="form-control" name="txtpw" id="txtpw" aria-describedby="helpId" placeholder="รหัสผ่าน" require>
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
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