<?php

        setcookie('updateSuccessProfile', '0', time() - 1, '/');
        setcookie('updateSuccessProfile', '1', time() - 1, '/');
        
        setcookie('realImage', '0', time() - 1, '/');
        setcookie('realImage', '1', time() - 1, '/');

        setcookie('quotations', '0', time() - 1, '/');

        setcookie('okay', '1', time() - 1, "/");

        setcookie('updateSuccessFZgames', '0', time() - 1, "/");
        setcookie('updateSuccessFZgames', '1', time() - 1, "/");
        setcookie('updateSuccessFZgames', '2', time() - 1, "/");
        setcookie('updateSuccessFZgames', '3', time() - 1, "/");

        setcookie('addGymnastSuccess', '0', time() - 1, "/");
        setcookie('addGymnastSuccess', '1', time() - 1, "/");
        setcookie('addGymnastSuccess', '2', time() - 1, "/");
        setcookie('addGymnastSuccess', '3', time() - 1, "/");

        setcookie('addCoachSuccess', '0', time() - 1, "/");
        setcookie('addCoachSuccess', '1', time() - 1, "/");
        setcookie('addCoachSuccess', '2', time() - 1, "/");
        setcookie('addCoachSuccess', '3', time() - 1, "/");

        setcookie('addClassSuccess', '0', time() - 1, "/");
        setcookie('addClassSuccess', '1', time() - 1, "/");
        setcookie('addClassSuccess', '3', time() - 1, "/");

        setcookie('addTaskSuccess', '0', time() - 1, "/");
        setcookie('addTaskSuccess', '1', time() - 1, "/");
        setcookie('addTaskSuccess', '3', time() - 1, "/");

        setcookie('addSkillSuccess', '0', time() - 1, "/");
        setcookie('addSkillSuccess', '1', time() - 1, "/");
        setcookie('addSkillSuccess', '3', time() - 1, "/");

        setcookie('addReviewSuccess', '0', time() - 1, "/");
        setcookie('addReviewSuccess', '1', time() - 1, "/");
        setcookie('addReviewSuccess', '3', time() - 1, "/");

        setcookie('addChallengeSuccess', '0', time() - 1, "/");
        setcookie('addChallengeSuccess', '1', time() - 1, "/");
        setcookie('addChallengeSuccess', '3', time() - 1, "/");

        setcookie('changePassword', '0', time() - 1, '/');
        setcookie('changePassword', '1', time() - 1, '/');
        setcookie('changePassword', '2', time() - 1, '/');
        setcookie('changePassword', '3', time() - 1, '/');
        
        setcookie('reviewTask', '0', time() - 1, '/');
        setcookie('reviewTask', '1', time() - 1, '/');

        setcookie('doneSkill', '0', time() - 1, '/');
        setcookie('doneSkill', '1', time() - 1, '/');

    if(isset($_POST["logout"])){
        setcookie("logout", "1", time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/index.php");
        exit(0);
    }


    if(!isset($_COOKIE["identity"])){
        header("location: http://localhost/FlexZone/web/index.php");
        exit(0);
    }
    
    $tb = $_COOKIE["table"];

    $id = $_COOKIE["id"];
    $identity = $_COOKIE["identity"];

    include('../database/sql.php');
    
    $res = mysqli_query($con, selectTable($tb, $id, $identity));
    
    $line = mysqli_fetch_object($res);

    setcookie("id", $id, time() + 86400, "/");
    setcookie("identity", $identity, time() + 86400, "/");
    setcookie("table", $tb, time() + 86400, "/");
    
    if($tb == "gymnast"){
        
        $username = "username_g";
        $password = "password_g";
        $birthdate = "birthdate_g";
        $fname = "fname_g";
        $lname = "lname_g";
        $gender = "gender_g";
        $quote = "quote_g";
        $instagram = "instagram_g";
        $facebook = "facebook_g";
        $favEquip = "favEquip_g";
    }
    elseif($tb == "coach"){
        
        $username = "username_c";
        $password = "password_c";
        $birthdate = "birthdate_c";
        $fname = "fname_c";
        $lname = "lname_c";
        $gender = "gender_c";
        $quote = "quote_c";
        $instagram = "instagram_c";
        $facebook = "facebook_c";
        $favEquip = "favEquip_c";
    }
    elseif($tb == "manager"){
        
        $username = "username_m";
        $password = "password_m";
        $birthdate = "birthdate_m";
        $fname = "fname_m";
        $lname = "lname_m";
        $gender = "gender_m";
        $quote = "quote_m";
        $instagram = "instagram_m";
        $facebook = "facebook_m";
        $favEquip = "favEquip_m";
    }

    if($line->$password == '123456'){
        echo "<form id='changePassword' method='POST' action='../php/changePassword.php'>
                <p> Welcome to FlexZone! This is your profile, make sure it's your password too!</p>
                <input type='password' name='changePassword' placeholder='New password'>
                <input type='password' name='confirmPassword' placeholder='Confirm password'>
                <button>Set</button>";

                if(isset($_COOKIE['changePassword'])){
                    if($_COOKIE['changePassword'] == 0){
                        echo "<p class='failParagraph'>You have to change your password!</p>";
                    }
                    elseif($_COOKIE['changePassword'] == 2){
                        echo "<p class='failParagraph'>Make sure your passwords match!</p>";
                    }
                    elseif($_COOKIE['changePassword'] == 3){
                        echo "<p class='failParagraph'>Sorry... can't change password now, try again later!</p>";
                    }
                }

        echo "</form>";
    }








    //$age

    $a = getdate();                         // print_r(getdate());
    $b = date_parse($line->$birthdate);    // print_r(date_parse($line->birthdate_g));

    if(($a['mon'] - $b['month']) == 0){
        $x = ($a['mday'] - $b['day'])/30;
    }
    else{
        $x = ($a['mon'] - $b['month'])/12;
    }
    $age = floor($a['year'] - $b['year'] + $x);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<title>" . $line->$username . "</title>"; ?>

    <link rel="stylesheet" href="../css/generalStyle.css">
    <link rel="stylesheet" href="../css/pStyle.css">

    

</head>
<body id='body'>
    <div class='top'>
        <p class='flexzone'>FlexZone</p>
        <button id='showNav' onclick=showNav()><span></span><span></span><span></span></button>
    </div>

    <div id='navDiv'>
        <button id='hideNav' onclick=hideNav()><i class='fas fa-chevron-right'></i></button>
        <nav>
            <img src="../img/miniLogo.png" alt="FlexZone">
            <button id='profileButton' class='clicked' onclick=showProfile()>Profile</button>
            <button id='fz-gamesButton' onclick=showFZGames()>FZ-games</button>
            <button id='communityButton' onclick=showCommunity()>Community</button>
            <button class="logout" onclick=logout()>logout</button>
        </nav>
    </div>





    
    <div class="container" id="profile">
        
        

        <form action="" method="POST" hidden="hidden">
            <input type="submit" id="logout" name="logout">
        </form>
        


        <div class="profileImageDiv">
            <?php echo "<img src='../userImages/" . $identity . ".png" . "' alt=''>";?>
                
            <button class="profileChooseImage" onclick=choose()>Choose</button>
        </div>



        <div class="profileUsernameAndTrophiesDiv">
            <h1><?php echo $line->$username; ?></h1>
        

            <?php
                if($tb == "gymnast"){
                    echo "<div class='profileTrophiesDiv'>";
                        echo "<div class='trophiesContainer'>";
                            $trophies = mysqli_query($con, selectId_chTrophies($identity));
                            $count = $trophies->num_rows;
                            
                            for($i = 1; $i <= $count; $i++){
                                echo "<span>.</span>";
                            }
                        echo "</div>";
                    echo "</div>";
                }
            ?>
    </div>
        
        
    <div class="profileNameAndAgeDiv">
        <p><?php echo $line->$fname . " " . $line->$lname; ?></p>
        <p><?php echo $age; ?></p>
            <?php
                if($line->$gender == "M"){
                    echo "<i class='fas fa-mars'></i>";
                }
                else{
                    echo "<i class='fas fa-venus'></i>";
                }
            ?>

    </div>




        <?php
            if($tb == "gymnast"){
//class   
                echo "<div class='profileClassDiv'>
                    <label>Class</label>
                    <span>";
                        
                            if($line->selection_g == 0){
                                $class = mysqli_query($con, selectNb_cl($age));
                                $class = mysqli_fetch_object($class);
                                echo $class->nb_cl;
                            }
                            else{
                                echo "SELECTION";
                            }
                        
                    echo "</span>
                    <button onclick=showSchedule() id='downSchedule'><i class='fas fa-chevron-down' ></i></button>
                    <button onclick=hideSchedule() id='upSchedule'><i class='fas fa-chevron-up' ></i></button>
                </div>";
            }
                
            if($tb == "coach"){
                echo "  <div class='profileClassDiv'>
                            <label>Schedule</label>
                            <span></span>
                            <button onclick=showSchedule() id='downSchedule'><i class='fas fa-chevron-down' ></i></button>
                            <button onclick=hideSchedule() id='upSchedule'><i class='fas fa-chevron-up' ></i></button>
                        </div>";
            }


//schedule


                if($tb != "manager"){
                    $schedule = mysqli_query($con, selectSchedule($tb, $id, $identity));
                                                    

                    $a = mysqli_fetch_object($schedule);
                    

                    echo "          <div class='profileScheduleDiv' id='profileScheduleDiv'>";
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
                    echo   "</div></div>";
                }
                            


//level 

                if($tb == "gymnast"){

                    
                    $remSkills = mysqli_query($con, selectRemainingSkills($line->level_g, $identity));

                    $progress = $remSkills->num_rows;

                    $doneSkills = mysqli_query($con, selectDoneSkills($line->level_g, $identity));


                    $progress = round(100 - $progress * 100/ ($progress + $doneSkills->num_rows));

                    if($progress == 100 && $line->level_g < 11){

                    $line->level_g++; 

                    mysqli_query($con, updateLevel($line->level_g, $identity));

                    $remSkills = mysqli_query($con, selectRemainingSkills($line->level_g, $identity));

                    $progress = $remSkills->num_rows;

                    $doneSkills = mysqli_query($con, selectDoneSkills($level_g, $identity));

                    $progress = round(100 - $progress * 100/ ($progress + $doneSkills->num_rows));
                                    
                    }

                echo "<p id='levelProgress' hidden='hidden'>" . $progress . "</p>";     //for js (progress bar width)
                

            echo "<div class='profileLevelDiv'>
                    <label>Level " . $line->level_g . "</label>
                    
                    <div class='progressBar'>
                        <div class='progress' id='progress'>
                        </div>
                    </div>

                    <button onclick=showSkills() id='downSkills'><i class='fas fa-chevron-down' ></i></button>
                    <button onclick=hideSkills() id='upSkills'><i class='fas fa-chevron-up' ></i></button>
                </div>";
//skills
                echo "<div class='profileSkillsDiv' id='profileSkillsDiv'>";
                
                    echo "<ul class='notDone'>";
                        while($skill = mysqli_fetch_object($remSkills)){
                            echo "<li>" . $skill->name_s . "</li>";
                        }
                    echo "</ul>";


                    echo "<ul class='done'>";
                        while($skill = mysqli_fetch_object($doneSkills)){
                            echo "<li>" . $skill->name_s . "</li>";
                        }
                    echo "</ul>";
                echo "</div>";
                
            }
//tasks         Skills instead of Task for optimization sake
            if($tb == "coach"){

                                
                $remTasks = mysqli_query($con, selectRemainingTasks($identity));

                $progress = $remTasks->num_rows;

                $doneTasks = mysqli_query($con, selectDoneTasks($identity));
                                                  

                if(($progress + $doneTasks->num_rows) == 0){
                    $progress = 100;
                }
                else{
                    $progress = round(100 - $progress * 100/ ($progress + $doneTasks->num_rows));
                }


            echo "<p id='levelProgress' hidden='hidden'>" . $progress . "</p>";     //for js (progress bar width)


            echo "<div class='profileLevelDiv'>
                <label>Tasks</label>
                
                <div class='progressBar'>
                    <div class='progress' id='progress'>
                    </div>
                </div>

                <button onclick=showSkills() id='downSkills'><i class='fas fa-chevron-down' ></i></button>
                <button onclick=hideSkills() id='upSkills'><i class='fas fa-chevron-up' ></i></button>
            </div>";
//tasks
            echo "<div class='profileSkillsDiv' id='profileSkillsDiv'>";

                echo "<ul class='notDone'>";
                    while($task = mysqli_fetch_object($remTasks)){
                        echo "<li>" . $task->description_t . "</li>";
                    }
                echo "</ul>";


                echo "<ul class='done'>";
                    while($task = mysqli_fetch_object($doneTasks)){
                        echo "<li><label>" . $task->description_t . "</label>
                                  <span>" . $task->review_t . "</span>
                              </li>";
                        
                    }
                echo "</ul>";
            echo "</div>";
            }

            if($tb != "manager"){
//equipment 
                $eq = mysqli_query($con, selectFavEquip($line->$favEquip));
                $eq = mysqli_fetch_object($eq);
                
                    echo "  <div class='profileFavEquipDiv' >
                                <label>Favorite Equipment</label>

                                <span id='eqNum' hidden>" . $line->$favEquip . "</span>
                                <span id='eq'>" . $eq->abbrev_e . "</span>
                

                                <button onclick=showEquip() id='downEquip'><i class='fas fa-chevron-down' ></i></button>
                                <button onclick=hideEquip() id='upEquip'><i class='fas fa-chevron-up' ></i></button>
                
                            </div>";
            }

        ?>
        
                
        
        <div class="profileEditableDiv">
            <form action="../php/updateProfile.php" enctype="multipart/form-data" method="POST">
                
                <input type='file' accept='image/*' value="Choose Image" name="chooseImage" id="chooseImage" hidden="hidden">
            
            

                    <?php
                        if($tb != "manager"){
                            echo "  <div class='equipmentList' id='equipmentList'>";
                                        
                            $equipment = mysqli_query($con, selectEquipment());
                                    
                            while($eq = mysqli_fetch_object($equipment)){
                                if($eq->id_e == $line->$favEquip){
                                    echo "<input type='radio' name='equipment' id='radio" . $eq->id_e . "' onclick=\"changeEquip('" . $eq->abbrev_e . "')\" value='" . $eq->id_e . "' checked><label>$eq->name_e</label>";
                                }
                                else{
                                    echo "<input type='radio' name='equipment' id='radio" . $eq->id_e . "' onclick=\"changeEquip('" . $eq->abbrev_e . "')\" value='" . $eq->id_e . "'><label>$eq->name_e</label>";
                                }
                            }
                        
                            echo "  </div>";
                    
                        }
//quote
                    echo "<label>Quote</label>";
                    echo "<input type='textarea' name='quote' value=\"" . $line->$quote . "\" placeholder='Quote'>";
//instagram 
//facebook      
                    echo "<i class='fab fa-instagram'></i>
                          <input type='text' name='instagram' value=\"" . $line->$instagram . "\" placeholder='Instagram'>

                          <i class='fab fa-facebook'></i>
                          <input type='text' name='facebook' value=\"" . $line->$facebook . "\" placeholder='Facebook'>";         
                ?>     
                
                <input type="submit" value="Update" name="update" id="update" hidden="hidden">
            </form>
        </div>



        <button class="profileUpdate" onclick=update()>update</button>



    </div>
    
            




<!------fz-games-------->


    <div id="fz-games">
        <?php
            $date = mysqli_query($con, selectMinEndDate());
            
            $date = mysqli_fetch_object($date);
            $endDate = $date->{"MIN(endDate_ch)"};
            $date = explode('-', $endDate);

            echo "<span id='y' hidden>" . $date[0] . "</span>";
            echo "<span id='m' hidden>" . $date[1] . "</span>";
            echo "<span id='d' hidden>" . $date[2] . "</span>";
            
        ?>
        <div class="hotChallenges container">
            <h2>Hot Challenges</h2>

            <div class="countdown">
                <div><span id="day">--</span></div>
                <div><span id="hour">--</span></div>
                <div><span id="minute">--</span></div>
                <div><span id="second">--</span></div>
            </div>

            <div class="challenges">
                <?php 
                    $ch = mysqli_query($con, selectHotTriedChallenge($endDate));
                                              
                                            
                    while($challenge = mysqli_fetch_object($ch)){
                        if($tb == 'coach'){
                            echo "<form class='challenge coach' method='POST' action='../php/updateFZ-games.php'>";
                        }
                        else{
                            echo "<form class='challenge' method='POST' action='../php/updateFZ-games.php'>";
                        }
                            echo "<label>" . $challenge->description_ch . "</label>";
                            if($tb == "coach"){
                                echo "<input type='text' name='recordChallenge' value='" . $challenge->record_ch . "'>";
                                echo "<input type='text' name='usernameChallenge_g' value='" . $challenge->username_g . "'>";
                                echo "<input type='text' name='usernameChallenge_c' value='" . $challenge->username_c . "'>";
                                echo "<input type='date' name='dateChallenge' class='dateChallenge' value='" . $challenge->date_ch . "'>";
                            }
                            else{
                                echo "<span>" . $challenge->record_ch . "</span>";
                                echo "<span>" . $challenge->username_g . "</span>";
                                echo "<span>" . $challenge->username_c . "</span>";
                                echo "<span>" . $challenge->date_ch . "</span>";
                            }
                            if($tb == "coach"){
                                echo "<button class='updateChallenge' name='submit' value='" . $challenge->id_ch . "'>Update</button>";
                            }
                        echo "</form>";
                    }

                    $ch = mysqli_query($con, selectHotUntriedChallenge($endDate));
                                            
                    while($challenge = mysqli_fetch_object($ch)){
                        if($tb == 'coach'){
                            echo "<form class='challenge coach' method='POST' action='../php/updateFZ-games.php'>";
                        }
                        else{
                            echo "<form class='challenge' method='POST' action='../php/updateFZ-games.php'>";
                        }
                            echo "<label>" . $challenge->description_ch . "</label>";
                            if($tb == "coach"){
                                echo "<input type='text' name='recordChallenge' value=''>";
                                echo "<input type='text' name='usernameChallenge_g' value=''>";
                                echo "<input type='text' name='usernameChallenge_c' value=''>";
                                echo "<input type='date' name='dateChallenge' class='dateChallenge' value=''>";
                            }
                            else{
                                echo "<span>Unset...Yet!</span>";
                                echo "<span></span>";
                                echo "<span></span>";
                                echo "<span></span>";
                            }
                            if($tb == "coach"){
                                echo "<button class='updateChallenge' name='submit' value='" . $challenge->id_ch . "'>Update</button>";
                            }
                        echo "</form>";
                    }
                ?>
            </div>
        </div>

        <div class="ongoingChallenges container">
            <h2>Ongoing Challenges</h2>

            <div class="challenges">
                <?php
                    $ch = mysqli_query($con, selectOngoingTriedChallenge($endDate));
                                            
                    while($challenge = mysqli_fetch_object($ch)){
                        if($tb == 'coach'){
                            echo "<form class='challenge coach' method='POST' action='../php/updateFZ-games.php'>";
                        }
                        else{
                            echo "<form class='challenge' method='POST' action='../php/updateFZ-games.php'>";
                        }
                            echo "<label>" . $challenge->description_ch . "</label>";
                            if($tb == "coach"){
                                echo "<input type='text' name='recordChallenge' value='" . $challenge->record_ch . "'>";
                                echo "<input type='text' name='usernameChallenge_g' value='" . $challenge->username_g . "'>";
                                echo "<input type='text' name='usernameChallenge_c' value='" . $challenge->username_c . "'>";
                                echo "<input type='date' name='dateChallenge' class='dateChallenge' value='" . $challenge->date_ch . "'>";
                            }
                            else{
                                echo "<span>" . $challenge->record_ch . "</span>";
                                echo "<span>" . $challenge->username_g . "</span>";
                                echo "<span>" . $challenge->username_c . "</span>";
                                echo "<span>" . $challenge->date_ch . "</span>";
                            }
                            if($tb == "coach"){
                                echo "<button class='updateChallenge' name='submit' value='" . $challenge->id_ch . "'>Update</button>";
                            }
                        echo "</form>";
                    }

                    $ch = mysqli_query($con, selectOngoingUntriedChallenge($endDate));
                                            
                    while($challenge = mysqli_fetch_object($ch)){
                        if($tb == 'coach'){
                            echo "<form class='challenge coach' method='POST' action='../php/updateFZ-games.php'>";
                        }
                        else{
                            echo "<form class='challenge' method='POST' action='../php/updateFZ-games.php'>";
                        }
                            echo "<label>" . $challenge->description_ch . "</label>";
                            if($tb == "coach"){
                                echo "<input type='text' name='recordChallenge' value=''>";
                                echo "<input type='text' name='usernameChallenge_g' value=''>";
                                echo "<input type='text' name='usernameChallenge_c' value=''>";
                                echo "<input type='date' name='dateChallenge' class='dateChallenge' value=''>";
                            }
                            else{
                                echo "<span>Unset...Yet!</span>";
                                echo "<span></span>";
                                echo "<span></span>";
                                echo "<span></span>";
                            }
                            if($tb == "coach"){
                                echo "<button class='updateChallenge' name='submit' value='" . $challenge->id_ch . "'>Update</button>";
                            }
                        echo "</form>";
                    }
                ?>
            </div>
        </div>

        <div class="upcomingChallenges container">
            <h2>Upcoming Challenges</h2>

            <div class="challenges">
                <?php

                    $ch = mysqli_query($con, selectUpcomingChallenge());
                                            
                                            
                    while($challenge = mysqli_fetch_object($ch)){
                        echo "<label>" . $challenge->description_ch . "</label>";
                    }
                    if($tb == 'coach'){
                        echo "<div class='add' onclick=showChallenge()>
                            <span class='hor'></span><span class='ver'></span>
                        </div>";

                        echo "<div class='addDiv' id='addChallengeDiv'>
                        <form class='addForm' id='addChallengeForm' method='POST' action='../php/addChallenge.php'>
                            <input type='textarea' name='addDescription' placeholder='Challenge description'>
                            <div class='startDate'>
                                <label>Starts in</label><input type='date' name='addStartDate'>
                            </div>
                            <div class='duration'>
                                <label>Lasts for</label><input type='number' min='1' max='3' name='addDuration'>
                                <span>month(s)</span>
                            </div>
                            <input type='submit' name='confirmChallenge' id='confirmChallenge' hidden>
                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelChallenge()>Cancel</button>
                            <button class='addButton' onclick=confirmChallenge()>Add</button>
                        </div>
                    </div>";

                    }
                ?>
            </div>
        </div>
    </div>
<!---community--->
    <div id="community">

        <div class="container">
        <?php
            //<div class="searchDiv">
            //    <input type="search">
            //</div>
        ?>
            <div class="communityDiv">
                <div class="communityClass"><span>COACHES</span></div>
                <div class="communityCoaches">
                    <?php
                        $res = mysqli_query($con, selectAllCoach($identity));
                        while($a = mysqli_fetch_object($res)){

                            echo "<div class='card'>";
                            if($tb == 'manager'){
                                echo "<form method='POST' action='editCoach.php'>";
                                    echo "<button value='" . $a->id_c . "' name='submit'><span></span><span></span><span></span></button>";
                                echo "</form>";
                            }
                                echo "<div class='imgBx'>";
                                    echo "<img src='../userImages/" . $a->id_c . "' alt=''>";
                                echo "</div>";
                                echo "<div class='main'>";
                                    echo "<span class='username'>" . $a->username_c . "</span>";
                                    echo "<span class='name'>" . $a->fname_c . " " . $a->lname_c . "</span>";
                                echo "</div>";
                                echo "<div class='content'>";
                                    
                                    echo "<span class='quote'>\"" . $a->quote_c . "\"</span>";

                                    $eq = mysqli_query($con, selectFavEquip($a->favEquip_c));
                                    $eq = mysqli_fetch_object($eq);
                                    echo "<span class='favEquip'>" . $eq->abbrev_e . "</span>";
                                    echo "<div class='socials'>";
                                        echo "<a class='instagram' href='https://www.instagram.com/" . $a->instagram_c . "' target='_blank'><i class='fab fa-instagram'></i></a>";
                                        echo "<a class='facebook' href='https://www.facebook.com/" . $a->facebook_c . "' target='_blank'><i class='fab fa-facebook'></i></a>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    echo"</div>";

                    echo "<div class='communityClass'><span>GYMNASTS</span></div>";
                    echo "<div class='communityGymnasts'>";
                        $res = mysqli_query($con, selectAllGymnast($identity));
                        while($a = mysqli_fetch_object($res)){

                            echo "<div class='card'>";
                                if($tb != 'gymnast'){
                                    echo "<form method='POST' action='editGymnast.php'>";
                                        echo "<button value='" . $a->id_g . "' name='submit'><span></span><span></span><span></span></button>";
                                    echo "</form>";
                                }
                                echo "<div class='imgBx'>";
                                    echo "<img src='../userImages/" . $a->id_g . "' alt=''>";
                                echo "</div>";
                                echo "<div class='main'>";
                                    echo "<span class='username'>" . $a->username_g . "</span>";
                                    echo "<div class='trophies'>";
                                        $trophies = mysqli_query($con, selectId_chTrophies($a->id_g));
                                        $count = $trophies->num_rows;
                                        
                                        for($i = 1; $i <= $count; $i++){
                                            echo "<span>.</span>";
                                        }
                                    echo "</div>";
                                    echo "<span class='name'>" . $a->fname_g . " " . $a->lname_g . "</span>";
                                    
                                    if($a->selection_g == 1){
                                       echo "<span class='class'>SELECTION</span>";
                                   }
                                   else{
                                        $c = getdate();                         // print_r(getdate());
                                        $b = date_parse($a->birthdate_g);    // print_r(date_parse($line->birthdate_g));

                                        if(($c['mon'] - $b['month']) == 0){
                                            $x = ($c['mday'] - $b['day'])/30;
                                        }
                                        else{
                                            $x = ($c['mon'] - $b['month'])/12;
                                        }
                                        $age = floor($c['year'] - $b['year'] + $x);
                                        $class = mysqli_query($con, selectNb_cl($age));
                                        $class = mysqli_fetch_object($class);
                                        $class = $class->nb_cl;

                                        echo "<span class='class'>Class " . $class . "</span>";
                                    }
                                echo "</div>";
                                echo "<div class='content'>";
                                    
                                    
                                    echo "<span class='quote'>\"" . $a->quote_g . "\"</span>";

                                    $eq = mysqli_query($con, selectFavEquip($a->favEquip_g));
                                    $eq = mysqli_fetch_object($eq);
                                    echo "<span class='favEquip'>" . $eq->abbrev_e . "</span>";
                                   

                                    echo "<div class='socials'>";
                                        echo "<a class='instagram' href='https://www.instagram.com/" . $a->instagram_g . "' target='_blank'><i class='fab fa-instagram'></i></a>";
                                        echo "<a class='facebook' href='https://www.facebook.com/" . $a->facebook_g . "' target='_blank'><i class='fab fa-facebook'></i></a>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>"
                ?>
            </div>
            <?php
                if($tb == "manager"){
            echo   "<div class='add' id='add' onclick=showButtons()>
                        <span class='hor'></span><span class='ver'></span>
                    </div>
                    
                    <div class='buttonList' id='buttonList'>
                    <button class='hideButtons' onclick=hideButtons()><i class='fas fa-chevron-down'></i></button>";
                    
                    
                echo   "<button class='addGymnast' onclick=showGymnast()>Gymnast</button>
                        <button class='addCoach' onclick=showCoach()>Coach</button>
                        <button class='addClass' onclick=showClass()>Class</button>
                        <button class='addTask' onclick=showTask()>Task</button>
                        <button class='addSkill' onclick=showSkill()>Skill</button>";
                }
                //echo   "<button class='addReview' onclick=showReview()>Review</button>
                echo "</div>";
//add gymnast                    
                if($tb == "manager"){
                echo "<div class='addDiv' id='addGymnastDiv'>
                        <form class='addForm' id='addGymnastForm' method='POST' action='../php/addGymnast.php'>
                            <input type='text' name='addUsername' placeholder='Username'>
                            <input type='email' name='addEmail' placeholder='example@domain.com'>
                            <span>Password 123456</span>
                            <input type='text' name='addFname' placeholder='First Name'>
                            <input type='text' name='addLname' placeholder='Last Name'>
                            <div class='birthdate'>
                                <label>Birthdate</label><input type='date' name='addBirthdate'>
                            </div>
                            <div class='gender'>
                                <label>M</label><input type='radio' name='addGender' value='M'>
                                <input type='radio' name='addGender' value='F' checked><label>F</label>
                            </div>
                            <div class='selection'>
                                <label>Selection</label><input type='checkbox' name='addSelection' value='1'>
                            </div>
                            <div class='classGymnast'>";
                            
                                $res = mysqli_query($con, selectClasses());
                                while($a = mysqli_fetch_object($res)){
                                echo "<div class='selectClassDiv'>
                                        <input type='checkbox' name='addClass[]' value='" . $a->id_cl . "'>
                                        <label>$a->name_d</label>
                                        <label>";
                                            if($a->nb_cl == 0){echo"SELECTION";}
                                            else{echo $a->nb_cl;}
                                        echo "</label>
                                        <label>$a->hourStart_cl</label>
                                        <label>$a->hourEnd_cl</label>
                                    </div>";
                                }
                    echo   "</div>
                            <input type='submit' name='confirmGymnast' id='confirmGymnast' hidden>
                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelGymnast()>Cancel</button>
                            <button class='addButton' onclick=confirmGymnast()>Add</button>
                        </div>
                    </div>";
//add coach
            echo   "<div class='addDiv' id='addCoachDiv'>
                        <form class='addForm' id='addCoachForm' method='POST' action='../php/addCoach.php'>
                            <input type='text' name='addUsername' placeholder='Username'>
                            <input type='email' name='addEmail' placeholder='example@domain.com'>
                            <span>Password 123456</span>
                            <input type='text' name='addFname' placeholder='First Name'>
                            <input type='text' name='addLname' placeholder='Last Name'>
                            <div class='birthdate'>
                                <label>Birthdate</label><input type='date' name='addBirthdate'>
                            </div>
                            <div class='gender'>
                                <label>M</label><input type='radio' name='addGender' value='M'>
                                <input type='radio' name='addGender' value='F' checked><label>F</label>
                            </div>
                            <div class='classCoach'>";
                            
                                $res = mysqli_query($con, selectClasses());
                                while($a = mysqli_fetch_object($res)){
                                echo "<div class='selectClassDiv'>
                                        <input type='checkbox' name='addClass[]' value='" . $a->id_cl . "'>
                                        <label>$a->name_d</label>
                                        <label>";
                                            if($a->nb_cl == 0){echo"SELECTION";}
                                            else{echo $a->nb_cl;}
                                        echo "</label>
                                        <label>$a->hourStart_cl</label>
                                        <label>$a->hourEnd_cl</label>
                                    </div>";
                                }
                    echo   "</div>
                            <input type='submit' name='confirmCoach' id='confirmCoach' hidden>
                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelCoach()>Cancel</button>
                            <button class='addButton' onclick=confirmCoach()>Add</button>
                        </div>
                    </div>";
//add class
            echo   "<div class='addDiv' id='addClassDiv'>
                        <form class='addForm' id='addClassForm' method='POST' action='../php/addClass.php'>
                            <select name='day'>
                                <option value='1'>Monday</option>
                                <option value='2'>Tuesday</option>
                                <option value='3'>Wedday</option>
                                <option value='4'>Thursday</option>
                                <option value='5'>Friday</option>
                                <option value='6'>Saturday</option>
                                <option value='7'>Sunday</option>
                            </select>

                            <input type='number' max='3' min='0' name='classNumber' placeholder='Class number'>

                            <div class='startHour'>
                                <label>Start Hour</label>
                                <input type='time' name='startHour'>
                            </div>
                            <div class='endHour'>
                                <label>End Hour</label>
                                <input type='time' name='endHour'>
                            </div>

                            <input type='submit' name='confirmClass' id='confirmClass' hidden>

                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelClass()>Cancel</button>
                            <button class='addButton' onclick=confirmClass()>Add</button>
                        </div>
                    </div>";
//add task
            echo   "<div class='addDiv' id='addTaskDiv'>
                        <form class='addForm' id='addTaskForm' method='POST' action='../php/addTask.php'>
                            <input type='text' class='input' name='taskDescription' placeholder='Task description'>";
                            $c = mysqli_query($con, selectId_cUsername_c());
                           
                            while($uc = mysqli_fetch_object($c)){
                                    echo "<input type='checkbox' name='coach[]' value='" . $uc->id_c . "'><label>$uc->username_c</label>";
                            }
                            echo "<input type='submit' name='confirmTask' value='" . $identity . "' id='confirmTask' hidden>

                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelTask()>Cancel</button>
                            <button class='addButton' onclick=confirmTask()>Add</button>
                        </div>
                    </div>";
//add skill                    
            echo   "<div class='addDiv' id='addSkillDiv'>
                        <form class='addForm' id='addSkillForm' method='POST' action='../php/addSkill.php'>
                            <input type='text' class='input' name='skillName' placeholder='Skill name'>";
                            
                            $equipment = mysqli_query($con, selectEquipment());

                            while($eq = mysqli_fetch_object($equipment)){
                                    echo "<input type='radio' name='equipment' id='radio" . $eq->id_e . "' value='" . $eq->id_e . "'><label>$eq->name_e</label>";
                            }

                            echo "<input type='number' name='gymnastLevel' placeholder='Gymnast level' min='1' max='11'>

                            <input type='submit' name='confirmSkill' id='confirmSkill' hidden>

                        </form>
                        <div class='addButtonDiv'>
                            <button class='cancel' onclick=cancelSkill()>Cancel</button>
                            <button class='addButton' onclick=confirmSkill()>Add</button>
                        </div>
                    </div>";
                }
//add review
            echo "<div class='addDiv' id='addReviewDiv'>
                    <form class='addForm' id='addReviewForm' method='POST' action='../php/addReview.php'>
                        <input type='textarea' class='input' name='review' placeholder='Review'>
                        <span>COACHES</span>";
                        $c = mysqli_query($con, selectAllCoach($identity));
                            
                            while($uc = mysqli_fetch_object($c)){
                                echo "<input type='checkbox' name='to[]' value='" . $uc->id_c . "'><label>$uc->username_c</label>";
                            }
                        echo "<span>GYMNASTS</span>";
                        $g = mysqli_query($con, selectAllGymnast($identity));
                            
                            while($ug = mysqli_fetch_object($g)){
                                echo "<input type='checkbox' name='to[]' value='" . $ug->id_g . "'><label>$ug->username_g</label>";
                            }


                            echo "<input type='submit' name='confirmTask' value='" . $identity . "' id='confirmReview' hidden>

                    </form>
                    <div class='addButtonDiv'>
                        <button class='cancel' onclick=cancelReview()>Cancel</button>
                        <button class='addButton' onclick=confirmReview()>Add</button>
                    </div>
                </div>";
                
            ?>
            
        </div>
    </div>
    
    <?php

        if(isset($_COOKIE['changePassword'])){
            if($_COOKIE['changePassword'] == 1){
                echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
                    echo "<p class='successParagraph'>You password was changed successfully! Enjoy!</p>";
                echo "</div>";
            }
        }

        if(isset($_COOKIE['updateSuccessProfile'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if(isset($_COOKIE['realImage'])){
                if($_COOKIE['realImage'] == 1 && $_COOKIE['updateSuccessProfile'] == 1){
                    echo "<p class='successParagraph'>Profile updated successfully!</p>"; 
                }
                elseif($_COOKIE['realImage'] == 0){
                    echo "<p class='failParagraph'>Sorry... this type of image can't be stored</p>";
                    
                }
                elseif($_COOKIE['realImage'] == 1){
                    echo "<p class='successParagraph'>Profile Picture updated successfully!</p>";
                    echo "<p class='randomParagraph'>Might take a while to be shown!</p>"; 
                
                }
            }
            
            elseif($_COOKIE['updateSuccessProfile'] == 0){
                echo "<p class='failParagraph'>Sorry... can't update your information now, try again later!</p>";
                
            }
            else{
                echo "<p class='successParagraph'>Your information updated successfully!</p>"; 
                
            }
            echo "</div>";
        }
            
            

        if(isset($_COOKIE['quotations'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
                echo "<p class='failParagraph'>Make sure you remove the \" from your inputs</p>";
            echo '</div>';
        }

        if(isset($_COOKIE['okay'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
                echo "<p class='successParagraph'>Okay.....</p>";
            echo "</div>";
        }

        if(isset($_COOKIE['updateSuccessFZgames'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['updateSuccessFZgames'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['updateSuccessFZgames'] == 1){
                echo "<p class='successParagraph'>Challenge updated successfully!</p>";
            }

            elseif($_COOKIE['updateSuccessFZgames'] == 2){
                echo "<p class='failParagraph'>Make sure usernames are correct!</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't update challenge now, try again later!</p>";
            }
            echo "</div>";
        }
        
        if(isset($_COOKIE['addGymnastSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addGymnastSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addGymnastSuccess'] == 1){
                echo "<p class='successParagraph'>Gymnast added successfully</p>";
            }

            elseif($_COOKIE['addGymnastSuccess'] == 2){
                echo "<p class='successParagraph'>Gymnast added!</p>";
                echo "<p class='failParagraph'>But the classes hasn't been assigned, try editing them in later!</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new gymnast now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addCoachSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addCoachSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addCoachSuccess'] == 1){
                echo "<p class='successParagraph'>Coach added successfully</p>";
            }

            elseif($_COOKIE['addCoachSuccess'] == 2){
                echo "<p class='successParagraph'>Coach added!</p>";
                echo "<p class='failParagraph'>But the classes hasn't been assigned, try editing them in later!</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new coach now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addClassSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addClassSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addClassSuccess'] == 1){
                echo "<p class='successParagraph'>Class added successfully</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new class now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addTaskSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addTaskSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addTaskSuccess'] == 1){
                echo "<p class='successParagraph'>Task added successfully</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new task now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addSkillSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addSkillSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addSkillSuccess'] == 1){
                echo "<p class='successParagraph'>Skill added successfully</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new skill now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addReviewSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addReviewSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addReviewSuccess'] == 1){
                echo "<p class='successParagraph'>Review added successfully</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new review now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['addChallengeSuccess'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['addChallengeSuccess'] == 0){
                echo "<p class='failParagraph'>Make sure you entered all the information!</p>";
            }

            elseif($_COOKIE['addChallengeSuccess'] == 1){
                echo "<p class='successParagraph'>Challenge added successfully</p>";
            }

            else{
                echo "<p class='failParagraph'>Sorry... can't add a new challenge now, try again later!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['reviewTask'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['reviewTask'] == 0){
                echo "<p class='failParagraph'>Sorry... can't add review to tasks now, try again later!</p>";
            }

            else{
                echo "<p class='successParagraph'>Reviews to tasks were added successfully!</p>";
            }
            echo "</div>";
        }

        if(isset($_COOKIE['doneSkill'])){
            echo "<div class='profileSuccessDiv' id='profileSuccessDiv'>";
            if($_COOKIE['doneSkill'] == 0){
                echo "<p class='failParagraph'>Sorry... can't set skills as accomplished by gymnasts now, try again later!</p>";
            }

            else{
                echo "<p class='successParagraph'>Skills were set as accomplished successfully!</p>";
            }
            echo "</div>";
        }
        
        
    ?>
</body>
</html>

<script src="../js/profile.js"></script>
<script src="https://kit.fontawesome.com/b06485e99e.js" crossorigin="anonymous"></script>