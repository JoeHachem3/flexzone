<?php

    if(isset($_COOKIE["identity"])){
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    if(!isset($_COOKIE["table"])){
        header("location: http://localhost/FlexZone/web/index.php");
        exit(0);
    }
    
    $tb = $_COOKIE["table"];
    

    if($tb == "gymnast"){
        $id = "id_g";
        $username = "username_g";
        $password = "password_g";
    }
    elseif($tb == "coach"){
        $id = "id_c";
        $username = "username_c";
        $password = "password_c";
    }
    elseif($tb == "manager"){
        $id = "id_m";
        $username = "username_m";
        $password = "password_m";
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../css/generalStyle.css">
    <link rel="stylesheet" href="../css/loginStyle.css">

</head>
<body>
    <div class="container">
        <div class="loginBackDiv">
            <a href="index.php" class="loginBack"><i class="fas fa-arrow-left"></i></a>
        </div>

        <div class="loginDiv">
            
            <img src="../img/uniColorLogoWhiteBlue.png" alt="Logo" class="loginLogo">
            
            <?php
                echo "<h1>" . $tb . "</h1>";
            ?>   

            <form method="POST" action="" class="loginForm">    

                <input id="loginUsername" type="text" name="username" placeholder="Enter Username">

                <input id="loginPassword" type="password" name="password" placeholder="Enter Password">

                <input id="login" type="submit" name="login" value="Login" hidden="hidden">
            </form>
        
            <button onclick=login()>login</button>
            
            <p class='loginError' id='error'>
                <?php 
                    if(isset($_POST["login"])){
                        include('../database/sql.php');

                        if($_POST["username"] == NULL && $_POST["password"] == NULL){
                            echo "Both Username and Password are required!";
                        }else{

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
                                        header("location: http://localhost/FlexZone/web/profile.php");
                                    }
                                    else{
                                        echo "Make sure you entered the correct information!";
                                    }
                                }
                                else{
                                    echo "Password required!";
                                }
                            }
                            else{
                                echo "Username required!";
                            }
                        }
                    }
                ?>
            </p>
        </div>
    </div>
</body>
</html>

<script src="https://kit.fontawesome.com/b06485e99e.js" crossorigin="anonymous"></script>
<script src="../js/login.js"></script>