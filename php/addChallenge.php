<?php
    include('../database/sql.php');

    $_POST['addDescription'] = trim($_POST['addDescription']);

    if($_POST['addDescription'] =='' && $_POST['addStartDate'] =='' && $_POST['addDuration'] ==''){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['addDescription'] =='' || $_POST['addStartDate'] =='' || $_POST['addDuration'] ==''){
        setcookie('addChallengeSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        
        $endDate = explode("-", $_POST['addStartDate']);

        $endDate['1'] += $_POST['addDuration'];

        if($endDate['1'] > 12){
            $endDate['1'] = $endDate['1']%12;
            $endDate['0'] += 1;
        }

        $res = mysqli_query($con, insertChallenge($_POST['addDescription'], $_POST['addStartDate'], $endDate['0'], $endDate['1'], $endDate['2']));
    
        
        if($res){
            setcookie('addChallengeSuccess', '1', time() + 86400, "/");
        }
        else{
            setcookie('addChallengeSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");

    ?>