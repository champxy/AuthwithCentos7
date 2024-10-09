<?php
    $date = $_SESSION['timeout'];
    $dateEx = explode(' ',$date);
    $dates = explode('-',$dateEx[0]);
    $timeout = mysqli_fetch_assoc(mysqli_query($conn,'SELECT value FROM radgroupreply 
    WHERE groupname="'.$_SESSION['groupname'].'" AND attribute="Session-Timeout"'));
    $endtime = strtotime("+".$timeout['value']."seconds",strtotime($dateEx[1]));
    $timelogin = date('H:i:s',$endtime);
    $countDownDate1 = $dates[0]." ".$dates[1].",".$dates[2]." ".$timelogin;
    $user = mysqli_fetch_assoc(mysqli_query($conn,'SELECT radcheck.*,radusergroup.groupname FROM radcheck,radusergroup WHERE radcheck.username=radusergroup.username AND radcheck.username="'.$_SESSION['uid'].'"'));
?>
<div class="card" style="position: fixed;width: 25%">
                <div class="card-header text-center text-light" style="background-color:#00a651">
                    <h4>ผู้เข้าใช้งาน</h4>
                </div>
                <div class="card-body">
                    <div class="text-center"><img src="<?=$user['pic']?>" width="35%"></div><hr>
                    <p class="card-text">ชื่อผู้เข้าใช้งาน : <?=$user['fullname']?> <br>
                    สิทธิ์ผู้ใช้งาน : <?=$user['groupname']?> </p>
                </div>
                <div class="card-footer text-center text-white"style="background-color:#00a651" id="demo">
                </div>
                <a href="logout.php">
                <div class="card-footer text-center text-white bg-danger">
                    ออกจากระบบ
                </div>
                </a>
            </div>
            
<script>
    var countdown = "<?php echo $countDownDate1;?>";
    var countDownDate = new Date(countdown).getTime();
    var x = setInterval(function(){
        var now = new Date().getTime();
        var distance = countDownDate-now;
        var hours = Math.floor((distance%(1000*60*60*24))/(1000*60*60));
        var minutes = Math.floor((distance%(1000*60*60))/(1000*60));
        var seconds = Math.floor((distance%(1000*60)/1000));
        document.getElementById("demo").innerHTML = "<b>เวลาที่เหลือในการใช้งาน : <br>"+hours+" ชั่วโมง "+minutes+" นาที "+seconds+" วินาที "+"</b>";
        if(distance<0){
            clearInterval(x);
            document.getElementById("demo").innerHTML="<b>TIMEOUT</b>";
            alert("หมดเวลา");
            window.location.replace("http://1.0.0.0");
        }
    },1000);
</script> 