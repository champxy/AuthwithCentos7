<ul class="nav nav-tabs bg-info">
    <li class="nav-item">
        <a href="index.php" class="nav-link text-white"><i class="fa fa-compass" aria-hidden="true"></i> LTC Authentication</a>
    </li>
    <li class="nav-item">
        <a href="index.php" class="nav-link text-white"><i class="fa fa-home" aria-hidden="true"></i> หน้าหลัก</a>
    </li>
    <li class="nav-item">
        <a href="editmine.php" class="nav-link text-white"><i class="fa fa-user" aria-hidden="true"></i> แก้ไขข้อมูลส่วนตัว</a>
    </li>
    <li class="nav-item">
        <a href="timetolog.php" class="nav-link text-white"><i class="fa fa-clock" aria-hidden="true"></i> ข้อมูลการใช้งาน</a>
    </li>
    <?php if($_SESSION['groupname']=='admins'){ ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">การจัดการ</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="manageuser.php">จัดการผู้ใช้</a>
            <a class="dropdown-item" href="managegroup.php">จัดการกลุ่มผู้ใช้</a>
            <a class="dropdown-item" href="manageonline.php">จัดการผู้ใช้ที่กำลังออนไลน์</a>
            <a class="dropdown-item" href="managerequest.php">จัดการคำขอร้องการใช้งาน</a>
            <a class="dropdown-item" href="manageshift.php">จัดการผู้ใช้ชั่วคราว</a>
        </div>
    </li>
    <?php } ?>
</ul>