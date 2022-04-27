<?php
   
    $server = "localhost";
    $user = "fzlogin";
    $pass = "logintoflexzone";
    $db = "flexzone";

    $con = mysqli_connect($server, $user, $pass, $db) or die("connection failed");
