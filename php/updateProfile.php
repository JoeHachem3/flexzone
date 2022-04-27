<?php
    include('../database/sql.php');
    
    if($_COOKIE["table"] == "manager"){
        $tb = "Manager";
        $ig = "instagram_m";
        $fb = "facebook_m";
        $quote = "quote_m";
        $id = "id_m";
    }
    elseif($_COOKIE["table"] == "coach"){       
        $tb = "Coach";
        $ig = "instagram_c";
        $fb = "facebook_c";
        $quote = "quote_c";
        $id = "id_c";
        $favEquip = "favEquip_c";
    }
    else{    
        $tb = "Gymnast";
        $ig = "instagram_g";
        $fb = "facebook_g";
        $quote = "quote_g";
        $id = "id_g";
        $favEquip = "favEquip_g";
    }




    


    if($_FILES['chooseImage']['size'] != 0){
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
    }


    $_POST['quote'] = trim(trim($_POST['quote'], "\""));
    $_POST['instagram'] = trim(trim($_POST['instagram'], "\""));
    $_POST['facebook'] = trim(trim($_POST['facebook'], "\""));

    if(preg_match('/\"/', $_POST['quote']) || preg_match('/\"/', $_POST['instagram']) || preg_match('/\"/', $_POST['facebook'])){
        setcookie('quotations', '0', time() + 86400, '/');
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }


    $res = mysqli_query($con, updateTableInputs($tb, $ig, $_POST['instagram'], $fb, $_POST['facebook'], $quote, $_POST['quote'], $id, $_COOKIE['identity']));



                                                            
    if($tb != "manager"){
        mysqli_query($con, updateTableFavEquip($tb, $favEquip, $_POST['equipment'], $id, $_COOKIE['identity']));
    }                                            


    if($res){
        setcookie('updateSuccessProfile', '1', time() + 86400, '/');
    }
    else{
        setcookie('updateSuccessProfile', '0', time() + 86400, '/');
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>