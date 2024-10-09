<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $con = null;
    if(isset($_POST['tmp'])){
        $con = ' AND radcheck.username LIKE "%'.$_POST['tmp'].'%"';
    }
    $SQL = mysqli_query($conn,'SELECT radcheck.*,radusergroup.groupname FROM radcheck,radusergroup WHERE radcheck.username=radusergroup.username AND radusergroup.groupname="Makeshift" AND radcheck.username=radusergroup.username'.$con);
    if(isset($_POST['del'])){
        mysqli_query($conn,'DELETE radcheck.*,radusergroup.* FROM radcheck,radusergroup WHERE radcheck.username="'.$_POST['del'].'" AND radusergroup.username="'.$_POST['del'].'"');
        echo '<script>location.replace("manageshift.php")</script>';
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
<title>Makeshift Management</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST">
<div class="container">
    <div class="py-2">
        <div class="row">
            <div class="col-8">
            <div class="form-group form-inline">
              <input type="text"
                class="form-control" name="tmp" id="tmp" aria-describedby="helpId" placeholder="ค้นหาโดยใช้ชื่อผู้ใช้">
                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                <a href="insertshift.php" class="btn btn-warning ml-2 text-white">เพิ่มผู้ใช้งานชั่วคราว</a>
                <a href="genshift.php" class="btn btn-success ml-2 text-white">เพิ่มผู้ใช้ชั่วคราวอัตโนมัติ</a>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>กลุ่มผู้ใช้</th>
                            <th>จัดการ</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; while($rs=mysqli_fetch_assoc($SQL)){
                        $i++;
                    
                    ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$rs['username']?></td>
                            <td><?=$rs['fullname']?></td>
                            <td><?=$rs['groupname']?></td>
                            <td><a class="btn btn-warning text-white" href="editshift.php?username=<?=$rs['username']?>">แก้ไข</a></td>
                            <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modelIddel<?=$rs['username']?>">
                              ลบ
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modelIddel<?=$rs['username']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ต้องการลบข้อมูลกลุ่มผู้ใช้</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            ชื่อผู้ใช้ : <?=$rs['username']?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-danger" name="del" id="del" value="<?=$rs['username']?>">ลบ</button>
                                        </div>
                                    </div>
                                </div>
                            </div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-3">
            <?php include('userlog.php') ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</form>
</body>
<?php include('footer.php') ?>
</html>