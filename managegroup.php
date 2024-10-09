<?php
    include('connector.php');
    checklogin();
    checkgroup();
    kickice();
    makeshift();
    $con = null;
    if(isset($_POST['tmp'])){
        $con = ' AND groupname LIKE "%'.$_POST['tmp'].'%"';
    }
    $SQL = mysqli_query($conn,'SELECT DISTINCT(groupname) FROM radgroupcheck WHERE 1=1'.$con);
    if(isset($_POST['del'])){
        mysqli_query($conn,'DELETE radgroupcheck.*,radgroupreply.* FROM radgroupcheck,radgroupreply WHERE radgroupcheck.groupname="'.$_POST['del'].'" AND radgroupreply.groupname="'.$_POST['del'].'"');
        echo '<script>location.replace("managegroup.php")</script>';
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
<title>Group Management</title>
</head>
<?php include('nav.php') ?>
<body>
<form method="POST">
<div class="container">
    <div class="py-2">
        <div class="row">
            <div class="col-7">
            <div class="form-group form-inline">
              <input type="text"
                class="form-control" name="tmp" id="tmp" aria-describedby="helpId" placeholder="ค้นหาโดยใช้ชื่อกลุ่ม">
                <button type="submit" class="btn btn-primary ml-2">ค้นหา</button>
                <a href="insertgroup.php" class="btn btn-warning ml-2 text-white">เพิ่มกลุ่มผู้ใช้</a>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อกลุ่ม</th>
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
                            <td><?=$rs['groupname']?></td>
                            <td><a class="btn btn-warning text-white" href="editgroup.php?groupname=<?=$rs['groupname']?>">แก้ไข</a></td>
                            <td><!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modelIddel<?=$rs['groupname']?>">
                              ลบ
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modelIddel<?=$rs['groupname']?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ต้องการลบข้อมูลกลุ่มผู้ใช้</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            กลุ่ม : <?=$rs['groupname']?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-danger" name="del" id="del" value="<?=$rs['groupname']?>">ลบ</button>
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