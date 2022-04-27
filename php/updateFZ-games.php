<?php
    include('../database/sql.php');

    $_POST["recordChallenge"] = trim($_POST["recordChallenge"]);
    $_POST["usernameChallenge_g"] = trim($_POST["usernameChallenge_g"]);
    $_POST["usernameChallenge_c"] = trim($_POST["usernameChallenge_c"]);
    $_POST["dateChallenge"] = trim($_POST["dateChallenge"]);
    
    if($_POST["recordChallenge"] =='' && $_POST["usernameChallenge_g"] == '' && $_POST["usernameChallenge_c"] == '' && $_POST["dateChallenge"] == ''){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST["recordChallenge"] =='' || $_POST["usernameChallenge_g"] == '' || $_POST["usernameChallenge_c"] == '' || $_POST["dateChallenge"] == ''){
        setcookie('updateSuccessFZgames', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    else{
        $res = mysqli_query($con, selectId_gId_c($_POST['usernameChallenge_g'], $_POST['usernameChallenge_c']));
                                   
        if(mysqli_num_rows($res) == 1){
            $res = mysqli_fetch_object($res);
            
            
                $id_g = $res->id_g;
                $id_c = $res->id_c;
           
        }
        else{
            setcookie('updateSuccessFZgames', '2', time() + 86400, "/");
            header("location: http://localhost/FlexZone/web/profile.php");
            exit(0);
        }

        
        $res = mysqli_query($con, updateChallenge($_POST['recordChallenge'], $id_g, $id_c, $_POST['dateChallenge'], $_POST['submit']));
                                                       
        if($res){
            setcookie('updateSuccessFZgames', '1', time() + 86400, "/");
        }
        else{
            setcookie('updateSuccessFZgames', '3', time() + 86400, "/");
        }

        header("location: http://localhost/FlexZone/web/profile.php");
    }
?>
