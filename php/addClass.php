<?php
    include('../database/sql.php');

    if($_POST['classNumber'] =='' && $_POST['startHour'] =='' && $_POST['endHour'] ==''){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['classNumber'] =='' || $_POST['startHour'] =='' || $_POST['endHour'] ==''){
        setcookie('addClassSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        $res = mysqli_query($con, insertClass($_POST['day'], $_POST['classNumber'], $_POST['startHour'], $_POST['endHour']));
        
        
        if($res){
            
                setcookie('addClassSuccess', '1', time() + 86400, "/");
        }
        else{
            setcookie('addClassSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>