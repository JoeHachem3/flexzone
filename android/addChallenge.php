<?php
    include('sql.php');

    $response = array();

    $_POST['addDescription'] = trim($_POST['addDescription']);

    if($_POST['addDescription'] =='' && $_POST['addStartDate'] =='' && $_POST['addDuration'] ==''){
        $response['error'] = false;
        $response['message'] = 'okay...';
    }
    elseif($_POST['addDescription'] =='' || $_POST['addStartDate'] =='' || $_POST['addDuration'] ==''){
        $response['error'] = true;
        $response['message'] = 'Make sure to input all information!';
        
    }
    else{
        
        $endDate = explode("-", $_POST['addStartDate']);

        $endDate['1'] += $_POST['addDuration'];

        if($endDate['1'] > 12){
            $endDate['1'] = $endDate['1']%12;
            $endDate['0'] += 1;
        }

        $res = mysqli_query($con, insertChallenge($_POST['addDescription'], $_POST['addStartDate'], $endDate['0'], $endDate['1'], $endDate['2']));
    
        
        if($res){
            $response['error'] = false;
            $response['message'] = 'Challenge added successfully!';
        }
        else{
            $response['error'] = true;
            $response['message'] = "Sorry... can't add a new challenge now, try again later!";
        }
    }
echo json_encode($response);

?>