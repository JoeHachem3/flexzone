<?php
    include('../database/sql.php');

    $_POST['skillName'] = trim($_POST['skillName']);

    if($_POST['skillName'] =='' && !isset($_POST['equipment']) && $_POST['gymnastLevel'] ==''){
        setcookie('okay', '1', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }
    elseif($_POST['skillName'] =='' || !isset($_POST['equipment']) || $_POST['gymnastLevel'] ==''){
        setcookie('addSkillSuccess', '0', time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
        
    }
    else{
        $res = mysqli_query($con, insertSkill($_POST['skillName'], $_POST['equipment'], $_POST['gymnastLevel']));
        
        
        if($res){
            
                setcookie('addSkillSuccess', '1', time() + 86400, "/");
        }
        else{
            setcookie('addSkillSuccess', '3', time() + 86400, "/");
        }
    }
    header("location: http://localhost/FlexZone/web/profile.php");
?>