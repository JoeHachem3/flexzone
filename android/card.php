<?php
    include("sql.php");

   // $_POST['table'] = 'coach';
   // $_POST['table_l'] = 'gymnast';
    //$_POST['identity_l'] = '1001'; 

    if($_POST['table_l'] == 'coach'){
        $id = 'id_c';
        $quote = 'quote_c';
        $favEquip = 'favEquip_c';
        $instagram = 'instagram_c';
        $facebook = 'facebook_c';
    }
    else{
        $id = 'id_g';
        $quote = 'quote_g';
        $favEquip = 'favEquip_g';
        $instagram = 'instagram_g';
        $facebook = 'facebook_g';
    }

    $response = array();

    $res = mysqli_query($con, selectTable($_POST['table_l'], $id, $_POST['identity_l']));

    if($res){
        $a = mysqli_fetch_object($res);
        $response['error'] = false;
        
        $response['quote'] = $a->$quote;
        
        
        $eq = mysqli_query($con, selectFavEquip($a->$favEquip));
        $eq = mysqli_fetch_object($eq);

        $response['equipment'] = $eq->abbrev_e;
        $response['instagram'] = $a->$instagram;
        $response['facebook'] = $a->$facebook;

        if($_POST['table_l'] == 'gymnast' && $_POST['table'] == 'coach'){
            $skills = mysqli_query($con, selectRemainingSkills($a->level_g, $_POST['identity_l']));

            if($skills->num_rows == 0 && $a->level_g < 11){
            
                $a->level_g += 1;
                mysqli_query($con, updateLevel($a->level_g, $_POST['submit']));
            
                $skills = mysqli_query($con, selectRemainingSkills($a->level_g, $_POST['identity_l']));
            }

            $i = 0;
            while($x = mysqli_fetch_object($skills)){
                $response['name_s'][$i] = $x->name_s;
                $response['id_s'][$i] = $x->id_s;
                $i++;
            }

            if($i == 0){                                                //if no skills
                $response['skill'] = false;
                $response['name_s'][$i] = '';
                $response['id_s'][$i] = '';
            }
            else{
                $response['skill'] = true;
            }
        }

        else{                                                           //if user not coach OR didn't click on gymnast
            $response['name_s'][0] = '';
            $response['id_s'][0] = '';
        }
    }

    else{
        $response['error'] = true;
        $response['quote'] = '';
        $response['equipment'] = '';
        $response['instagram'] = '';
        $response['facebook'] = '';

    }

    echo json_encode($response);
?>