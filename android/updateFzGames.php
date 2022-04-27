<?php
    include("sql.php");

    $response = array();

    $_POST["recordChallenge"] = trim($_POST["recordChallenge"]);
    $_POST["usernameChallenge_g"] = trim($_POST["usernameChallenge_g"]);
    $_POST["usernameChallenge_c"] = trim($_POST["usernameChallenge_c"]);
    $_POST["dateChallenge"] = trim($_POST["dateChallenge"]);
    
    if($_POST["recordChallenge"] =='' && $_POST["usernameChallenge_g"] == '' && $_POST["usernameChallenge_c"] == '' && $_POST["dateChallenge"] == ''){
        $response['error'] = false;
        $response['message'] = "okay....";
    }
    elseif($_POST["recordChallenge"] =='' || $_POST["usernameChallenge_g"] == '' || $_POST["usernameChallenge_c"] == '' || $_POST["dateChallenge"] == ''){
        $response['error'] = true;
        $response['message'] = "Make sure to input all information!";
    }
    else{
        $res = mysqli_query($con, selectId_gId_c($_POST["usernameChallenge_g"], $_POST["usernameChallenge_c"]));
                                   
        if(mysqli_num_rows($res) == 1){
            $res = mysqli_fetch_object($res);
            
                $id_g = $res->id_g;
                $id_c = $res->id_c;
           
        }
        else{
            $response['error'] = true;
            $response['message'] = "Oops couldn't update challenge... please try again later!";
        }

        $res = mysqli_query($con,updateChallenge($_POST['recordChallenge'], $id_g, $id_c, $_POST['dateChallenge'], $_POST['submit']));
                                                       
        if($res){
            $response['error'] = false;
            $response['message'] = "Challenge updated successfylly!";
        }
        else{
            $response['error'] = true;
            $response['message'] = "Failed to update challenge... is the date correct?";
        }
    }
echo json_encode($response);
?>