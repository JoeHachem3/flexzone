<?php
    include('../database/sql.php');
    
    $_POST['review'] = trim($_POST['review']);

    if($_POST['review'] =='' && !isset($_POST['to'])){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['review'] =='' || !isset($_POST['to'])){
        setcookie('addReviewSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        foreach($_POST['to'] as $id){
            $res = mysqli_query($con, insertReview($_COOKIE['identity'], $id, $_POST['review']));
        }
        
        if($res){
            
                setcookie('addReviewSuccess', '1', time() + 86400, "/");
        }
        else{
            setcookie('addReviewSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>