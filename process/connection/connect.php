<?php
    $con = mysqli_connect('localhost', 'root','', 'workchat');
    mysqli_query($con, "SET time_zone='+00:00'");

    date_default_timezone_set("UTC");

    if(mysqli_connect_errno()){
        echo "Falha ao se conectar no banco de dados.";
        exit();
    }
?>