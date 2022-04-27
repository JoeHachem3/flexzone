<?php
    include('../database/sql.php');

    if(!isset($_POST['id'])){
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    else{
        foreach($_POST['id'] as $id){
            $res = mysqli_query($con, insertGymnastSkill($_POST['add'], $id));
        }

        if($res){
            setcookie('doneSkill', '1', time() + 86400, '/');
        }
        else{
            setcookie('doneSkill', '0', time() + 86400, '/');
        }
        header("location: http://localhost/FlexZone/web/profile.php");
    }
?>