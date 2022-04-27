<?php
    include("sql.php");
    
    $tb = $_POST["table"];

    if($tb == "coach"){
        $ig = "instagram_c";
        $fb = "facebook_c";
        $quote = "quote_c";
        $id = "id_c";
        $favEquip = "favEquip_c";
    }
    else{    
        $ig = "instagram_g";
        $fb = "facebook_g";
        $quote = "quote_g";
        $id = "id_g";
        $favEquip = "favEquip_g";
    }

    $response = array();


    


    /*if($_FILES['chooseImage']['size'] != 0){
        include("cropImage.php");
        
        $name_file = $_COOKIE['identity'];
        $tmp_name = $_FILES['chooseImage']['tmp_name'];
        $type = $_FILES['chooseImage']['type'];
        unset($_FILES['chooseImage']);
        $local_image = "../userImages/";
        $file = $local_image.$name_file . ".png";

        if(preg_match('/image\//', $type)){
            
            imagepng(imagecreatefromstring(file_get_contents($tmp_name)), $file);

            crop_image($file, 200);
            
            setcookie('realImage', '1', time() + 86400, '/');
        }
        else{
            setcookie('realImage', '0', time() + 86400, '/');
        }
    }*/


    $_POST['quote'] = trim(trim($_POST['quote'], "\""));
    $_POST['instagram'] = trim(trim($_POST['instagram'], "\""));
    $_POST['facebook'] = trim(trim($_POST['facebook'], "\""));

    if(preg_match('/\"/', $_POST['quote']) || preg_match('/\"/', $_POST['instagram']) || preg_match('/\"/', $_POST['facebook'])){
        $response['error'] = true;
        $response['message'] = "Make sure you remove the \" from your inputs";
    }

    else{
        $res = mysqli_query($con, updateTableInputs($tb, $_POST['instagram'], $fb, $_POST['facebook'], $quote, $_POST['quote'], $id, $_POST['identity']));
        
        
    }
        $x = mysqli_query($con, selectId_e($_POST['equipment']));
        $x = mysqli_fetch_object($x);
        $a = mysqli_query($con, updateTableFavEquip($tb, $favEquip, $x->id_e, $id, $_POST['identity']));



    if($res && $a){
        $response['error'] = false;
        $response['message'] = "Profile successfully updated!";
    }
    else{
        $response['error'] = true;
        $response['message'] = "Could not update your profile... please try again later!";
    }

    echo json_encode($response);
?>