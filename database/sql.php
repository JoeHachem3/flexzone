<?php
    //Encryption
    
    //Decryption

    include("access.php");

    function insertGymnastSkill($id_g, $id_s){
        return "INSERT INTO gymnast_skill (id_g, id_s) VALUES ('" . $id_g . "', '" . $id_s . "')";
    }

    function insertGymnast($username, $email, $name, $lname, $birthdate, $gender, $selection){
        return "INSERT INTO gymnast (username_g, email_g, fname_g, lname_g, birthdate_g, gender_g, selection_g)
                VALUES ('" . $username . "', '" . $email . "', 
                        '" . $fname . "', '" . $lname . "', '" . $birthdate . "', 
                        '" . $gender . "', '" . $selection . "')";
    }

    function selectId_g($username){
        return "SELECT id_g FROM gymnast WHERE username_g = '" . $username . "'";
    }

    function insertGymnastClass($id_g, $id_cl){
        return "INSERT INTO gymnast_class (id_g, id_cl) VALUES ('" . $id_g . "', '" . $id_cl . "')";
    }

    function updateTableInputs($tb, $ig, $instagram, $fb, $facebook, $q, $quote, $id, $identity){
        return "UPDATE " . $tb . " SET " . $ig . " = \"" . $instagram . "\", " 
                                                         . $fb . " = \"" . $facebook . "\", "
                                                         . $q . " = \"" . $quote . "\" WHERE " 
                                                         . $id . " = '" . $identity . "'";
    }

    function updateTableFavEquip($tb, $favEquip, $equipment, $id, $identity){
        return "UPDATE " . $tb . " SET " . $favEquip . " = \"" . $equipment . "\" WHERE " . $id . " = '" . $identity . "'";
    }

    function insertChallenge($description, $startDate, $year, $month, $day){
        return "INSERT INTO challenge (description_ch, startDate_ch, endDate_ch)
                                   VALUES ('" . $description . "', '" . $startDate . "', '" . $year . "-" . $month . "-" . $day . "')";
    }


    function insertCoach($username ,$email, $fname, $lname, $birthdate, $gender){
        return "INSERT INTO coach (username_c, email_c, fname_c, lname_c, birthdate_c, gender_c)
                VALUES ('" . $username . "', '" . $email . "', 
                        '" . $fname . "', '" . $lname . "', '" . $birthdate . "', 
                        '" . $gender . "')";
    }

    function selectId_c($username){
        return "SELECT id_c FROM coach WHERE username_c = '" . $username . "'";
    }

    function insertCoachClass($id_c, $id_cl){
        return "INSERT INTO coach_class (id_c, id_cl) VALUES ('" . $id_c . "', '" . $id_cl . "')";
    }

    function updatePassword($table, $password, $changePassword, $id, $identity){
        return "UPDATE " . $table . " SET " . $password . "= '" . $changePassword . "' 
                WHERE " . $id . " = '" . $identity . "'";
    }

    function insertReview($identity, $id, $review){
        return "INSERT INTO review (idFrom_rv, idTo_rv, content_rv)
                VALUES ('" . $identity . "', '" . $id . "', '" . $review . "')";
    }

    function insertClass($day, $classNumber, $startHour, $endHour){
        return "INSERT INTO class (id_cl, id_d, nb_cl, hourStart_cl, hourEnd_cl)
                VALUES ('" . $day . $classNumber . "', '" . $day . "', '" . $classNumber . "', 
                        '" . $startHour . "', '" . $endHour . "')";
    }

    function insertTask($identity, $taskDescription){
        return "INSERT INTO task (id_m, description_t)
                VALUES ('" . $identity . "', '" . $taskDescription . "')";
    }

    function selectMaxId_t($id_m){
        return "SELECT MAX(id_t) FROM task WHERE id_m = '" . $id_m . "'";
    }

    function insertCoachTask($id_c, $id_t){
        return "INSERT INTO coach_task (id_c, id_t) VALUES ('" . $id_c . "', '" . $id_t . "')";
    }

    function updateCoachTask($review, $id, $id_c){
        return "UPDATE coach_task SET review_t = '" . $review . "'
                WHERE id_t = '" . $id . "'
                AND   id_c = '" . $id_c . "'";
    }

    function insertSkill($skillName, $equipment, $gymnastLevel){
        return "INSERT INTO skill (name_s, id_e, level_g)
                VALUES ('" . $skillName . "', '" . $equipment . "', '" . $gymnastLevel . "')";
    }

    function selectId_gId_c($usernameChallenge_g, $usernameChallenge_c){
        return "SELECT id_g, id_c FROM gymnast, coach 
                                  WHERE username_g ='" . $usernameChallenge_g . "'
                                  AND username_c ='" . $usernameChallenge_c . "'";
    }

    function updateChallenge($recordChallenge, $id_g, $id_c, $dateChallenge, $id_ch){
        return "UPDATE challenge SET record_ch = '" . $recordChallenge . "',
                                     id_g = '" . $id_g . "',
                                     id_c = '" . $id_c . "',
                                     date_ch = '" . $dateChallenge . "'
                                     WHERE id_ch = '" . $id_ch . "'
                                     AND startDate_ch <= '" . $dateChallenge . "'
                                     AND endDate_ch > '" . $dateChallenge . "'";
    }

    function selectTable($tb, $id, $identity){
        return "SELECT * FROM " . $tb . " WHERE " . $id . " = '" . $identity . "' limit 1";
    }

    function selectId_chTrophies($identity){
        return "SELECT id_ch FROM challenge WHERE id_g = '" . $identity . "' AND endDate_ch <= CURRENT_DATE";
    }

    function selectNb_cl($age){
        return "SELECT nb_cl FROM classAge WHERE ageStart_cl <= '" . $age . "' AND ageEnd_cl > '" . $age . "' limit 1";
    }

    function selectSchedule($tb, $id, $identity){
        return "SELECT class.*, day.name_d FROM class, day, " . $tb . "_class
                WHERE " . $tb . "_class." . $id . " = '" . $identity . "'
                AND class.id_cl =" . $tb . "_class.id_cl
                AND class.id_d = day.id_d
                ORDER BY id_cl";
    }

    function selectRemainingSkills($level_g, $identity){
        return "SELECT name_s, id_s FROM skill 
                WHERE skill.level_g = '" . $level_g . "' 
                AND skill.id_s NOT IN(
                SELECT skill.id_s FROM skill, gymnast_skill, gymnast 
                WHERE skill.id_s = gymnast_skill.id_s 
                AND gymnast_skill.id_g = '" . $identity . "')";
    }

    function selectDoneSkills($level_g, $identity){
        return "SELECT name_s FROM skill, gymnast_skill 
                WHERE skill.id_s = gymnast_skill.id_s 
                AND gymnast_skill.id_g = '" . $identity . "'
                AND skill.level_g = '" . $level_g . "'";
    }

    function updateLevel($level_g, $identity){
        return "UPDATE gymnast SET level_g = '" . $level_g . "' 
                WHERE id_g = '" . $identity . "'";
    }

    function selectRemainingTasks($identity){
        return "SELECT description_t FROM task, coach_task
                WHERE coach_task.id_c = '" . $identity . "'
                AND coach_task.id_t = task.id_t
                AND review_t = ''";
    }

    function selectDoneTasks($identity){
        return "SELECT description_t, review_t FROM task, coach_task
                WHERE coach_task.id_c = '" . $identity . "'
                AND coach_task.id_t = task.id_t
                AND review_t != ''";
    }

    function selectFavEquip($favEquip){
        return "SELECT abbrev_e FROM equipment WHERE id_e = '" . $favEquip ."'";
    }

    function selectEquipment(){
        return "SELECT * FROM equipment";
    }

    function selectMinEndDate(){
        return "SELECT MIN(endDate_ch) FROM challenge WHERE startDate_ch <= CURRENT_DATE AND endDate_ch > CURRENT_DATE";
    }

    function selectHotTriedChallenge($endDate){
        return "SELECT challenge.*, gymnast.username_g, coach.username_c 
                FROM challenge, gymnast, coach 
                WHERE (startDate_ch <= CURRENT_DATE 
                AND endDate_ch = '" . $endDate . "' 
                AND challenge.id_g = gymnast.id_g 
                AND challenge.id_c = coach.id_c)";
    }

    function selectHotUntriedChallenge($endDate){
        return "SELECT description_ch, id_ch
                FROM challenge 
                WHERE startDate_ch <= CURRENT_DATE 
                AND endDate_ch = '" . $endDate . "' 
                AND challenge.id_g IS NULL 
                AND challenge.id_c IS NULL";
    }

    function selectOngoingTriedChallenge($endDate){
        return "SELECT challenge.*, gymnast.username_g, coach.username_c 
                FROM challenge, gymnast, coach 
                WHERE (startDate_ch <= CURRENT_DATE 
                AND endDate_ch > '" . $endDate . "' 
                AND challenge.id_g = gymnast.id_g 
                AND challenge.id_c = coach.id_c)";
    }

    function selectOngoingUntriedChallenge($endDate){
        return "SELECT description_ch, id_ch
                FROM challenge 
                WHERE startDate_ch <= CURRENT_DATE 
                AND endDate_ch > '" . $endDate . "' 
                AND challenge.id_g IS NULL 
                AND challenge.id_c IS NULL";
    }

    function selectUpcomingChallenge(){
        return "SELECT description_ch
                FROM challenge 
                WHERE startDate_ch > CURRENT_DATE limit 2";
    }

    function selectAllCoach($identity){
        return "SELECT * FROM coach WHERE id_c != '" . $identity . "'";
    }

    function selectAllGymnast($identity){
        return "SELECT * FROM gymnast WHERE id_g != '" . $identity . "'";
    }

    function selectClasses(){
        return "SELECT day.name_d, id_cl, nb_cl, hourStart_cl, hourEnd_cl FROM day, class WHERE day.id_d = class.id_d ORDER BY id_cl";
    }

    function selectId_cUsername_c(){
        return "SELECT id_c, username_c FROM coach";
    }

    function selectLogin($tb, $username, $u, $password, $p){
        return "SELECT * FROM " . $tb . " WHERE " . $username . " = '" . $u . "' AND " . $password . " = '" . $p . "' limit 1";
    }

    function selectLevel_gUsername_gGymnast($identity) {
        return "SELECT level_g, username_g FROM gymnast WHERE id_g = '" . $identity . "'";
    }

    function selectUsername_cCoach($identity){
        return "SELECT username_c FROM coach WHERE id_c = '" . $identity . "'";
    }

    function selectTask($identity){
        return "SELECT task.id_t, description_t, review_t FROM task, coach_task 
                WHERE coach_task.id_t = task.id_t
                AND coach_task.id_c = '" . $identity . "'";
    }

    function selectUngivenTask($identity){
        return "SELECT id_t, description_t FROM task WHERE task.id_t NOT IN(
                SELECT task.id_t FROM coach_task, task WHERE task.id_t = coach_task.id_t AND coach_task.id_c = '" . $identity . "')";
    }

?>