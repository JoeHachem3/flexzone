<?php
    include('../database/sql.php');

    $_POST['changePassword'] = trim($_POST['changePassword']);
    $_POST['confirmPassword'] = trim($_POST['confirmPassword']);

    if($_POST['changePassword'] == '' && $_POST['confirmPassword'] == ''){
        setcookie('changePassword', '0', time() + 86400, '/');
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    elseif($_POST['changePassword'] != $_POST['confirmPassword']){
        setcookie('changePassword', '2', time() + 86400, '/');
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    else{

        if($_COOKIE['table'] == 'gymnast'){
            $password = 'password_g';
        }
        elseif($_COOKIE['table'] == 'coach'){
            $password = 'password_c';
        }
        else{
            $password = 'password_m';
        }

        $res = mysqli_query($con, updatePassword($_COOKIE['table'], $password, $_POST['changePassword'], $_COOKIE['id'], $_COOKIE['identity']));

        if($res){
            setcookie('changePassword', '1', time() + 86400, '/');
        }

        else{
            setcookie('changePassword', '3', time() + 86400, '/');
        }
        header("location: http://localhost/FlexZone/web/profile.php");
    }
?>