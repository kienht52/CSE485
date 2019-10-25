<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./img/logo.jpg">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/sign.css">
</head>
<body>
    <div class="form">
        <form class="form-group" action="" method="post">
            <div class="icon"><i class="fas fa-user-shield"></i></div>
            <input id="input" class="form-control" type="email" name="emailre" placeholder="Email" required>
            <button class="btn btn-primary btn-block" type="submit" name="send" >Send</button>
            <div id="row">
                <a href="Signup.php"><i class="fas fa-lock"></i> Create new account</a>
                <br>
                <a href="Login.php"><i class="fas fa-lock"></i> Already have an account? Login</a>            
            </div>
        </form>
    </div>
    
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</body>
</html>

<?php
    include 'Connect.php';
    if (isset($_POST["send"]))
    {
        $m = $_POST['emailre'];
        $qr = "select email from users where email='$m'";
        $re = mysqli_query($con,$qr);
        if (mysqli_fetch_array($re)!=0)
        {
            $pa = password_hash("123456",PASSWORD_DEFAULT);
            $qq = "update users set pass='$pa' where email='$m'";
            mysqli_query($con,$qq);
            $subject = "Lost password!";
            $txt = "Mật khẩu của bạn đã được reset về 123456";
            $headers = "From: admin@admin";
            mail($m,$subject,$txt,$headers);
            header("location:./Success.php");
        }
        else
        {
            echo "<script>alert('Không tồn tại email')</script>";
        }
    }
    mysqli_close($con);
?>