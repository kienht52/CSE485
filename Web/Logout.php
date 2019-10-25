<?php
session_start();
session_destroy();
setcookie('dangnhap', '', time()- 900);
header('location:./index.php');
?>