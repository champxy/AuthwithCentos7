<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    if(isset($_POST['save'])){
        $check = 'SELECT groupname FROM radgroupcheck WHERE groupname="'.$_POST['groupname'].'"';
        $nums = mysqli_num_rows(mysqli_query($conn,$check));
        if($nums==0){
        $download = $_POST['download']*1048576;
        $upload = $_POST['upload']*1048576;
        $SQL1 = 'INSERT INTO radgroupcheck (groupname,attribute,op,value) 
        VALUE ("'.$_POST['groupname'].'","Auth-Type",":=","Accept")';
        $SQL2 = 'INSERT INTO radgroupcheck (groupname,attribute,op,value) 
        VALUE ("'.$_POST['groupname'].'","Simultaneous-Use",":=",'.$_POST['count'].')';
        $SQL3 = 'INSERT INTO radgroupreply (groupname,attribute,op,value) 
        VALUE ("'.$_POST['groupname'].'","WISPr-Bandwidth-Max-Down",":=",'.$download.')';
        $SQL4 = 'INSERT INTO radgroupreply (groupname,attribute,op,value) 
        VALUE ("'.$_POST['groupname'].'","WISPr-Bandwidth-Max-Up",":=",'.$upload.')';
        $SQL5 = 'INSERT INTO radgroupreply (groupname,attribute,op,value) 
        VALUE ("'.$_POST['groupname'].'","Session-Timeout",":=",'.$_POST['timeout'].')';
        if((mysqli_query($conn,$SQL1)==true)&&(mysqli_query($conn,$SQL2)==true)&&(mysqli_query($conn,$SQL3)==true)&&(mysqli_query($conn,$SQL4)==true)&&(mysqli_query($conn,$SQL5))){
            echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
            echo '<script>location.replace("managegroup.php")</script>';
        }else{
            echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้")</script>';
            echo '<script>location.replace("managegroup.php")</script>';
        }
    }else{
        echo '<script>alert("มีกลุ่มผู้ใช้นี้แล้ว")</script>';
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>INSERT GROUP</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST" enctype="multipart/form-data">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="col-md-5 mt-3">
                <h3>เพิ่มข้อมูลกลุ่มผู้ใช้</h3>
                <div class="card mt-3">
                    <div class="card-body">
                    <div class="form-group">
                  <label for="">GROUPNAME</label>
                  <input type="text"
                    class="form-control" name="groupname" id="groupname" aria-describedby="helpId" placeholder="groupname" required>
                    <hr>
                    <label for="">จำนวนเครื่องที่ต้องการให้ใช้</label>
                  <input type="number"
                    class="form-control" name="count" id="count" aria-describedby="helpId" placeholder="จำนวนเครื่องที่ต้องการให้ใช้" required>
                    <hr>
                    <label for="">Download Speed [Mb/s]</label>
                  <input type="number"
                    class="form-control" name="download" id="download" aria-describedby="helpId" placeholder="Download Speed [Mb/s]" required>
                    <label for="">Upload Speed [Mb/s]</label>
                  <input type="number"
                    class="form-control" name="upload" id="upload" aria-describedby="helpId" placeholder="Upload Speed [Mb/s]" required>
                    <hr>
                    <label for="">Timeout [วินาที]</label>
                  <input type="number"
                    class="form-control" name="timeout" id="timeout" aria-describedby="helpId" placeholder="Timeout" required>
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