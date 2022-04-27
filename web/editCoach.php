<?php
    include('../database/sql.php');



if(isset($_POST['t'])){
        foreach($_POST['t'] as $t){
            $res = mysqli_query($con, insertCoachTask($_POST['submit'], $t));
        }
    }

    $a = mysqli_query($con, selectUsername_cCoach($_POST['submit']));
    $a = mysqli_fetch_object($a);

    $tasks = mysqli_query($con, selectTask($_POST['submit']));
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $a->username_c; ?></title>

    <link rel="stylesheet" href="../css/generalStyle.css">
    <link rel="stylesheet" href="../css/pStyle.css">

</head>
<body>
    <div class="container editDiv">
        <?php
            
            echo "<label>" . $a->username_c . "</label>";
            $i = 0;

            echo "<form class='editCoachForm' id='editCoachForm' method='POST' action='../php/editCoach.php'>";

            while($task = mysqli_fetch_object($tasks)){
                $i++;
                echo "<label>" . $task->description_t . "</label>";
                echo "<input type='text' value ='" . $task->id_t . "' name='id[]' hidden>";
                echo "<input type='text' name='review[]' placeholder='Review' value='" . $task->review_t . "'>";
                
            }

            if($i != 0){
                echo "<button name='add' value='" . $_POST['submit'] . "'>Add</button>";
            }
            else{
                echo "<button>Return</button>";
            }
            echo "</form>";








            
                echo "<p>Do you want to assign new tasks?</p>";
                echo "<button class='addTask' onclick=showTask()>Assign</button>";
                

                echo   "<div class='addDiv' id='addTaskDiv'>
                            <form class='addForm' id='addTaskForm' method='POST' action=''>
                                <span>" . $a->username_c . "</span>";
                                $a = mysqli_query($con, selectUngivenTask($_POST['submit']));
                                
                                while($b = mysqli_fetch_object($a)){
                                    echo "<input type='checkbox' name='t[]' value='" . $b->id_t . "'>
                                    <label>" . $b->description_t . "</label>";
                                }
                                echo "<input type='text' name='submit' value='" . $_POST['submit'] . "' hidden>
                                      <input type='submit' name='confirmTask' value='" . $_COOKIE['identity'] . "' id='confirmTask' hidden>

                            </form>
                            <div class='addButtonDiv'>
                                <button class='cancel' onclick=cancelTask()>Cancel</button>
                                <button class='addButton' onclick=confirmTask()>Add</button>
                            </div>
                        </div>";
        ?>
    </div>
</body>
</html>

<script src="../js/profile.js"></script>

    