<?php
    include('../database/sql.php');

    
    $a = mysqli_query($con, selectLevel_gUsername_gGymnast($_POST['submit']));
    $a = mysqli_fetch_object($a);

    $skills = mysqli_query($con, selectRemainingSkills($a->level_g, $_POST['submit']));

    if($skills->num_rows == 0 && $a->level_g < 11){
        
        $a->level_g += 1;
        mysqli_query($con, updateLevel($a->level_g, $_POST['submit']));        
    
        $skills = mysqli_query($con, selectRemainingSkills($a->level_g, $_POST['submit']));
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $a->username_g; ?></title>

    <link rel="stylesheet" href="../css/generalStyle.css">
    <link rel="stylesheet" href="../css/pStyle.css">
</head>
<body>
    <div class="container editDiv">
    <?php
        echo "<label>" . $a->username_g . "</label>";
        echo "<label>Level " . $a->level_g . "</label>";

            echo "<form class='editGymnastForm' id='editGymnastForm' method='POST' action='../php/editGymnast.php'>";
            
            while($skill = mysqli_fetch_object($skills)){
                echo "<label>" . $skill->name_s . "</label>";
                echo "<input type='checkbox' value ='" . $skill->id_s . "' name='id[]'>";
                
            }
            echo "<button name='add' value='" . $_POST['submit'] . "'>Add</button>";
        echo "</form>";
                
        ?>
    </div>
    
</body>
</html>
