<?php


    include('sql.php');

    $response = array(); 

    $tb = $_POST["table"];
    

//variables definition

    if($tb == "gymnast"){
        $id = "id_g";
        $username = "username_g";
        $password = "password_g";
        $fname = "fname_g";
        $lname = "lname_g";
        $favEquip = "favEquip_g";
        $gender = "gender_g";
        $instagram = "instagram_g";
        $facebook = "facebook_g";
        $level = "level_g";
        $birthdate = "birthdate_g";
        $quote = "quote_g";
            }

    elseif($tb == "coach"){
        $id = "id_c";
        $username = "username_c";
        $password = "password_c";
        $fname = "fname_c";
        $lname = "lname_c";
        $favEquip = "favEquip_c";
        $gender = "gender_c";
        $instagram = "instagram_c";
        $facebook = "facebook_c";
        $level = "level_c";
        $birthdate = "birthdate_c";
        $quote = "quote_c";
    }



    if($_POST["username"] == NULL && $_POST["password"] == NULL){
        echo "Both Username and Password are required!";
    }
    else{

        if($_POST["username"] != NULL){
            if($_POST["password"] != NULL){
                $u = trim($_POST["username"]);
                $p = trim($_POST["password"]);
                
                $res = mysqli_query($con, selectLogin($tb, $username, $u, $password, $p));
                
                if(mysqli_num_rows($res) == 1){
                    $line = mysqli_fetch_object($res);

                    $identity = $line->$id;
                    
                    setcookie("id", $id, time() + 86400, "/");
                    setcookie("identity", $identity, time() + 86400, "/");
                    
//age                    
                    $a = getdate();                         // print_r(getdate());
                    $b = date_parse($line->$birthdate);    // print_r(date_parse($line->birthdate_g));

                    if(($a['mon'] - $b['month']) == 0){
                        $x = ($a['mday'] - $b['day'])/30;
                    }
                    else{
                        $x = ($a['mon'] - $b['month'])/12;
                    }
                    $age = floor($a['year'] - $b['year'] + $x);

//favEquip
                    $eq = mysqli_query($con, selectFavEquip($line->$favEquip));
                    $eq = mysqli_fetch_object($eq);
                    $favEquip = array();
                    $favEquip['abbrev'] = $eq->abbrev_e;
                    $favEquip['id'] = $eq->id_e;
                    $favEquip['name'] = $eq->name_e;
                    
                    
                    
//equipment
                    $e = mysqli_query($con, selectEquipment());
                                    
                    $equipment = array();    

                        while($eq = mysqli_fetch_object($e)){
                            //if($eq->id_e == $favEquip['id']){
                                
                                $equipment[$eq->id_e] = $eq->name_e;
                            //}
                            //else{
                                //echo "<input type='radio' name='equipment' id='radio" . $eq->id_e . "' value='" . $eq->id_e . "'><label>$eq->name_e</label>";
                            //}
                        }

//schedule
                    $schedule = mysqli_query($con, selectSchedule($tb, $id, $identity));
                            $i = 0;
                            $classId = array();
                            $dayId = array();
                            $dayName = array();
                            $startHour = array();
                            $endHour = array();
                     while($a = mysqli_fetch_object($schedule)){
                        $classId[$i] = $a->id_cl;
                        $dayId[$i] = $a->id_d;
                        $dayName[$i] = $a->name_d;
                        $startHour[$i] = $a->hourStart_cl;
                        $endHour[$i] = $a->hourEnd_cl;
                        $i++;
                     }

                    


                   
                    

                    /*echo "          <div class='profileScheduleDiv' id='profileScheduleDiv'>";
                            echo "      <div class='day " . $a->name_d . "'>
                                        <label>" . $a->name_d . "</label>
                                    
                                        <span class='start'>" . $a->hourStart_cl . "</span>
                                        <span class='end'>" . $a->hourEnd_cl . "</span>";
                    while($b = mysqli_fetch_object($schedule)){
                        if($b->id_d == $a->id_d){
                            echo "      <span class='start'>" . $b->hourStart_cl . "</span>
                                        <span class='end'>" . $b->hourEnd_cl . "</span>";
                        }
                        else{
                            echo "      </div>";

                            echo "      <div class='day " . $b->name_d . "'>
                                        <label>" . $b->name_d . "</label>
                                    
                                        <span class='start'>" . $b->hourStart_cl . "</span>
                                        <span class='end'>" . $b->hourEnd_cl . "</span>";
                        }
                        $a = $b;
                    }
                }
                            echo   "</div></div>";*/

                    
                    

                    if($tb == "gymnast"){
                    
                            $remSkills = mysqli_query($con, selectRemainingSkills($line->level_g, $identity));
                            
                            $progress = $remSkills->num_rows;

                            $doneSkills = mysqli_query($con, selectDoneSkills($line->level_g, $identity));
        
                            $progress = round(100 - $progress * 100/ ($progress + $doneSkills->num_rows));

                            if($progress == 100){
        
                                $line->level_g++; 
            
                                mysqli_query($con, updateLevel($line->level_g, $identity));
            
                                $remSkills = mysqli_query($con, selectRemainingSkills($line->level_g, $identity));
            
                                $progress = $remSkills->num_rows;

                                $doneSkills = mysqli_query($con, selectDoneSkills($line->level_g, $identity));
                                                        
                                $progress = round(100 - $progress * 100/ ($progress + $doneSkills->num_rows));
                            }

//skills
                            

                            $remaining = array();
                            $done = array();
                            $i = 0;
                           
                            while($a = mysqli_fetch_object($remSkills)){
                                $remaining[$i] = $a->name_s;
                                $i++;
                            }
                            $i = 0;
                            while($a = mysqli_fetch_object($doneSkills)){
                                $done[$i] = $a->name_s;
                                $i++;
                            }
                            
//trophies

                        $trophies = mysqli_query($con, selectId_chTrophies($identity));
                        $trophies = $trophies->num_rows;
                    
//class                    
                        if($line->selection_g == 0){
                            $class = mysqli_query($con, selectNb_cl($age));
                            $class = mysqli_fetch_object($class);
                            $class = $class->nb_cl;
//level
                            $level = $line->level_g;
                        }
                        else{
                            $class = "SELECTION";
                        }

                        $review = "";
                    }
                    else{                        
                        $trophies = "0";
                        $class = "";
                        $level = "";
//tasks
                        $remSkills = mysqli_query($con, selectRemainingTasks($identity));

                        $progress = $remSkills->num_rows;

                        $doneSkills = mysqli_query($con, selectDoneTasks($identity));


                        $progress = round(100 - $progress * 100/ ($progress + $doneSkills->num_rows));

                        $i = 0;
                        while($a = mysqli_fetch_object($remSkills)){
                            $remaining[$i] = $a->description_t;
                            $i++;
                        }
                        
                        $i = 0;
                        while($a = mysqli_fetch_object($doneSkills)){
                            $done[$i] = $a->description_t;
                            $review[$i] = $a->review_t;
                            $i++;
                        }
                        if ($i == 0) {
                            $review = " ";
                            $done= " ";
                           }
                    }
//response
                    $response['error'] = false;
                    
                    $response['id'] = $identity;
                    $response['username'] = $line->$username;       
                    $response['fname'] = $line->$fname;
                    $response['lname'] = $line->$lname;
                    $response['age'] = $age;
                    $response['gender'] = $line->$gender;
                    $response['trophies'] = $trophies;
                    $response['quote'] = $line->$quote;
                    $response['instagram'] = $line->$instagram;
                    $response['facebook'] = $line->$facebook;
                    $response['class'] = $class;                    //class 1 2 3 or SELECTION
                    $response['level'] = $level;


                    $response['progress'] = $progress;              //skills / tasks
                    $response['review'] = $review; 
                    $response['remaining'] = $remaining;            //undone skills / tasks
                    $response['done'] = $done;                 //task review
                    

                    $response['favEquip'] = $favEquip;
                    $response['equipment'] = $equipment;            //list of equip
                    $response['classId'] = $classId;
                    $response['dayId'] = $dayId;                    //schedule
                    $response['dayName'] = $dayName;                //schedule
                    $response['startHour'] = $startHour;            //schedule
                    $response['endHour'] = $endHour;                //schedule
                       

                    $p = $_POST["password"];
                    $response['password'] = $p;
                    $response['table'] = $tb;               //done skills / tasks
                   



                    
                }
                else{
                    $response['error'] = true;
                    $response['message'] = "Make sure you entered the correct password";
                }
            }
            else{
                $response['error'] = true;
                $response['message'] =  "Password required!";
            }
        }
        else{
            $response['error'] = true;
            $response['message'] =  "Username required!";
        }
    }

echo json_encode($response);


?>


