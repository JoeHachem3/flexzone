<?php
    include('../database/sql.php');

    $_POST['addUsername'] = trim($_POST['addUsername']);
    $_POST['addEmail'] = trim($_POST['addEmail']);
    $_POST['addFname'] = trim($_POST['addFname']);
    $_POST['addLname'] = trim($_POST['addLname']);


    if($_POST['addUsername'] =='' && $_POST['addEmail'] =='' && $_POST['addFname'] =='' 
        && $_POST['addLname'] =='' && $_POST['addBirthdate'] =='' && !isset($_POST['addSelection']) && !isset($_POST['addClass'])){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['addUsername'] =='' || $_POST['addEmail'] =='' || $_POST['addFname'] =='' 
        || $_POST['addLname'] =='' || $_POST['addBirthdate'] =='' || !isset($_POST['addSelection']) || !isset($_POST['addClass'])){
        setcookie('addGymnastSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        $res = mysqli_query($con, insertGymnast($_POST['addUsername'], $_POST['addEmail'], $_POST['addFname'], $_POST['addLname'], 
                                                $_POST['addBirthdate'], $_POST['addGender'], $_POST['addSelection']));
        
        
        if($res){
            $a = mysqli_query($con, selectId_g($_POST['addUsername']));
            $a = mysqli_fetch_object($a);

            foreach($_POST['addClass'] as $addClass){
                $res = mysqli_query($con, insertGymnastClass($a->id_g, $addClass));
            }

            if($res){
                setcookie('addGymnastSuccess', '1', time() + 86400, "/");
            }
            else{
                setcookie('addGymnastSuccess', '2', time() + 86400, "/");
            }
        }
        else{
            setcookie('addGymnastSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>