<?php
    include('../database/sql.php');

    if(!isset($_POST['id'])){
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    else{
        $i = 0;
        foreach($_POST['review'] as $review){
            $id = $_POST['id'][$i];
            
            $res = mysqli_query($con, updateCoachTask($review, $id, $_POST['add']));
            
            $i++;
        }

        if($res){
            setcookie('reviewTask', '1', time() + 86400, '/');
        }
        else{
            setcookie('reviewTask', '0', time() + 86400, '/');
        }
        header("location: http://localhost/FlexZone/web/profile.php");
    }
?>