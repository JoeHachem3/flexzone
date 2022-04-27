<?php
    include('../database/sql.php');

    $_POST['taskDescription'] = trim($_POST['taskDescription']);

    if($_POST['taskDescription'] =='' && !isset($_POST['coach'])){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['taskDescription'] =='' || !isset($_POST['coach'])){
        setcookie('addTaskSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        $res = mysqli_query($con, insertTask($_COOKIE['identity'], $_POST['taskDescription']));
        $res = mysqli_query($con, selectMaxId_t($_COOKIE['identity']));
        $res = mysqli_fetch_object($res);
        $id_t = $res->{MAX(id_t)};
        echo $id_t;

        foreach($_POST['coach'] as $id_c){
            $res = mysqli_query($con, insertCoachTask($id_c, $id_t));

        }
        
        
        if($res){
            setcookie('addTaskSuccess', '1', time() + 86400, "/");
        }
        else{
            setcookie('addTaskSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>