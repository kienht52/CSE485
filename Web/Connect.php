<?php
    $con = mysqli_connect("localhost","root","","dbf");
    if (!$con)
    {
        die("Connection error: " . mysqli_connect_errno());
    }
    mysqli_set_charset($con,"UTF8");
?>