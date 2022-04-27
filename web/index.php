<?php
    
    if(isset($_COOKIE["logout"])){
        setcookie("id", $_COOKIE["id"], time() - 1, "/");
        setcookie("identity", $_COOKIE["identity"], time() - 1, "/");
        setcookie("table", $_COOKIE["table"], time() - 1, "/");
        setcookie("logout", $_COOKIE["logout"], time() - 1, "/");
    }
    elseif(isset($_COOKIE["identity"])){
        header("location: http://localhost/FlexZone/web/profile.php");
        exit(0);
    }

    if(isset($_COOKIE["table"])){
        setcookie("table", $_COOKIE["table"], time() - 1, "/");
    }

    if(isset($_POST["gymnast"])){
        setcookie("table", "gymnast", time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/login.php");
        exit(0);
    }
    elseif(isset($_POST["coach"])){
        setcookie("table", "coach", time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/login.php");
        exit(0);
    }
    elseif(isset($_POST["manager"])){
        setcookie("table", "manager", time() + 86400, "/");
        header("location: http://localhost/FlexZone/web/login.php");
        exit(0);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlexZone</title>
    
    <link rel="stylesheet" href="../css/generalStyle.css">
    <link rel="stylesheet" href="../css/style.css">
    
</head>

<body>
    <div class="container">
        <img src="../img/uniColorLogoWhiteBlue.png" alt="Logo" class="mainLogo">
    
        <p class="mainParagraph">
            Welcome to our page! <br>
            Make yourself comfy, log in to your account, find new challenges and enjoy the process! <br>
            Oh and by the way, don't forget to update your profile picture... you look way better now!
        </p>

        <div class="mainButtonDiv">
                <button onclick=gymnast()>Gymnast</button>

                <button onclick=coach()>Coach</button>

                <button onclick=manager()>Manager</button>
                
                <form action="" method="POST" hidden="hidden">
                    <input type="submit" name="gymnast" id="gymnast">
                    <input type="submit" name="coach" id="coach">
                    <input type="submit" name="manager" id="manager">
                </form>
        </div>

        <div class="mainSocials">
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-facebook"></i></a>
            <a href=""><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</body>
</html>

<script src="https://kit.fontawesome.com/b06485e99e.js" crossorigin="anonymous"></script>
<script src="../js/tableSelectIndex"></script>