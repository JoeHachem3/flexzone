<?php

    include('sql.php');
        $date = mysqli_query($con, selectMinEndDate());
        
        $date = mysqli_fetch_object($date);
        $endDate = $date->{"MIN(endDate_ch)"};
        $date = explode('-', $endDate);

        $response = array();

        $response['closestEndDate'] = $date;
        


//hot challenges

        $ch = mysqli_query($con, selectHotTriedChallenge($endDate));
                                        

$response['challengeDescription11'][0] ="..";
  $response['challengeRecord11'][0] ="..";
  $response['challengeGymnast11'][0] = "..";
  $response['challengeCoach11'][0] =  "..";
$response['challengeDate11'][0]= "..";
$response['challengeId11'][0] = "..";

        $i = 1;
        while($challenge = mysqli_fetch_object($ch)){                               //hot challenges with records
                                                                                    //grouped by index
            $response['challengeDescription11'][$i] = $challenge->description_ch;       //name(description)
            $response['challengeRecord11'][$i] = $challenge->record_ch;                 //record
            $response['challengeGymnast11'][$i] = $challenge->username_g;               //held by
            $response['challengeCoach11'][$i] = $challenge->username_c;                 //verified by
            $response['challengeDate11'][$i] = $challenge->date_ch;                     //in
            $response['challengeId11'][$i] = $challenge->id_ch;                         //id as value for the update button... 
            $i++;                                                                       //to know what challenge to update in the database
        }                                                                           
        

        $ch = mysqli_query($con, selectHotUntriedChallenge($endDate));
        
       
        $response['challengeDescription12'][0] = "..";
        $response['challengeId12'][0] = "..";
        $i = 1;
        while($challenge = mysqli_fetch_object($ch)){
                                                                            //hot challenges with no records
            $response['challengeDescription12'][$i] = $challenge->description_ch;
            $response['challengeId12'][$i] = $challenge->id_ch;
            $i++;                                                            
        }
    
//ongoing challenges

        $ch = mysqli_query($con, selectOngoingTriedChallenge($endDate));
        


 $response['challengeDescription21'][0] ="..";
  $response['challengeRecord21'][0] ="..";
  $response['challengeGymnast21'][0] = "..";
  $response['challengeCoach21'][0] =  "..";
$response['challengeDate21'][0]= "..";
$response['challengeId21'][0] = "..";
        $i = 1;
        while($challenge = mysqli_fetch_object($ch)){
            $response['challengeDescription21'][$i] = $challenge->description_ch;       //name(description)
            $response['challengeRecord21'][$i] = $challenge->record_ch;                 //record
            $response['challengeGymnast21'][$i] = $challenge->username_g;               //held by
            $response['challengeCoach21'][$i] = $challenge->username_c;                 //verified by
            $response['challengeDate21'][$i] = $challenge->date_ch;                     //in
            $response['challengeId21'][$i] = $challenge->id_ch;
            $i++;
        }

        $ch = mysqli_query($con, selectOngoingUntriedChallenge($endDate));

        $response['challengeDescription22'][0] = "..";
        $response['challengeId22'][0] = "..";
        $i = 1;
        while($challenge = mysqli_fetch_object($ch)){
            $response['challengeDescription22'][$i] = $challenge->description_ch;
            $response['challengeId22'][$i] = $challenge->id_ch;
            $i++;
        }
 
//upcoming challenges

        $ch = mysqli_query($con, selectUpcomingChallenge());
          
        $response['challengeDescription31'][0] = "..";                         
        $i = 1;                        
        while($challenge = mysqli_fetch_object($ch)){
            $response['challengeDescription31'][$i] = $challenge->description_ch;
            $i++;
        }
echo json_encode($response);
?>