<?php
    include('sql.php');

//checkbox with value skill id (id_s)
//check the skill that is accomplished by the gymnast

//call this file when the return button is pressed

//need id_g, id_s

    $response = array();

    if(!isset($_POST['id_s'])){                                     //if pressed back and no editing was made... okay... nothing
        $response['error'] = false;
        $response['message'] = '';
    }

    else{
        foreach($_POST['id_s'] as $id){
            $res = mysqli_query($con, insertGymnastSkill($_POST['id_g'], $id));
        }

        if($res){
            $response['error'] = false;
            $response['message'] = 'Skills set as accomplished successfully!';
        }
        else{
            $response['error'] = true;
            $response['message'] = "Sorry... can't set skills as accomplished by gymnasts now, try again later!";
        }
    }

    echo json_encode($response);
?>