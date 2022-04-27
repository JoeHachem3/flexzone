<?php

    include('sql.php');

    $response = array();
   // $_POST['identity'] = "1001";

//COACHES

    $res = mysqli_query($con, selectAllCoach($_POST['identity']));    //all coaches except the user
    
    $i = 0;                                                                                         //index
    while($a = mysqli_fetch_object($res)){
                    
        //echo "<div class='imgBx'>";
        //    echo "<img src='../userImages/" . $a->id_c . "' alt=''>";
        //echo "</div>";
     
        $response['id_c'][$i] = $a->id_c;                                                           //most probably, you won't need that
        $response['username_c'][$i] = $a->username_c;
        $response['name_c'][$i] = $a->fname_c . " " . $a->lname_c;                                  //fname + lname
       // $response['quote_c'][$i] = $a->quote_c;
        
        $eq = mysqli_query($con, selectFavEquip($a->favEquip_c));
        $eq = mysqli_fetch_object($eq);

       // $response['equipment_c'][$i] = $eq->abbrev_e;                                                 //equipment abbreviation
       // $response['instagram_c'][$i] = $a->instagram_c;
       // $response['facebook_c'][$i] = $a->facebook_c;

       $i++;
    }

    if($i == 0){
        $response['id_c'][$i] = '';
        $response['username_c'][$i] = '';
        $response['name_c'][$i] = '';
       // $response['quote_c'][$i] = '';
       // $response['equipment_c'][$i] = '';
       // $response['instagram_c'][$i] = '';
       // $response['facebook_c'][$i] = '';
    }




//GYMNASTS

    $res = mysqli_query($con, selectAllGymnast($_POST['identity']));
    
    $i = 0;
    while($a = mysqli_fetch_object($res)){
                    
        //echo "<div class='imgBx'>";
        //    echo "<img src='../userImages/" . $a->id_g . "' alt=''>";
        //echo "</div>";
     
        $response['id_g'][$i] = $a->id_g;                                                           //to access their remaining skills
        $response['username_g'][$i] = $a->username_g;
        $response['name_g'][$i] = $a->fname_g . " " . $a->lname_g;
       // $response['quote_g'][$i] = $a->quote_g;
        
       // $eq = mysqli_query($con, selectFavEquip($a->favEquip_g));
        //$eq = mysqli_fetch_object($eq);

        //$response['equipment_g'][$i] = $eq->abbrev_e;
       // $response['instagram_g'][$i] = $a->instagram_g;
     //   $response['facebook_g'][$i] = $a->facebook_g;

        $trophies = mysqli_query($con, selectId_chTrophies($a->id_g));
        $count = $trophies->num_rows;
        
        $response['trophies_g'][$i] = $count;                                                       //trophy count
       
        $i++;
    }

    if($i == 0){
        $response['id_g'][$i] = '';
        $response['username_g'][$i] = '';
        $response['name_g'][$i] = '';
      //  $response['quote_g'][$i] = '';
      //  $response['equipment_g'][$i] = '';
       // $response['instagram_g'][$i] = '';
       // $response['facebook_g'][$i] = '';
        $response['trophies_g'][$i] = '';
    }
    
echo json_encode($response);
?>