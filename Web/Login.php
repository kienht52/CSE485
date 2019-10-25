<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./img/logo.jpg">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/sign.css">
</head>
<body>
    <div class="form">
        <form class="form-group" action="" method="post">
            <div class="icon"><i class="fas fa-user"></i></div>
            <input id="input" class="form-control" type="text" name="usern" placeholder="Username/Email" required>
            <input id="input" class="form-control" type="password" name="pass" placeholder="Password" required>
            <button class="btn btn-primary btn-block" type="submit" name="dangnhap" >Log In</button>
            <div id="row">
                <a href="Signup.php"><i class="fas fa-lock"></i> Create new account</a>
                <br>
                <a href="Forgot.php"><i class="fas fa-lock"></i> Forgot your email or password?</a>            
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
    if (isset($_POST['dangnhap']))
    {
        $usern = $_POST['usern'];
        $password = $_POST['pass'];
        $qr = "select * from users where username='$usern' or email='$usern'";
        $re = mysqli_query($con,$qr);
        if (mysqli_num_rows($re)>0)
        {
            while ($row = mysqli_fetch_array($re))
            {
                if (password_verify($password,$row["pass"]))
                {
                    $_SESSION['dangnhap'] = $usern;
                    setcookie('dangnhap', $usern, time() + 900);
                    header("location:./Admin.php");
                    exit;
                }
                else
                {
                    echo "<script>alert('Sai mật khẩu')</script>";
                }
            }
        }
        else
        {
            echo "<script>alert('Sai thông tin')</script>";
        }
    }
    unset($email,$password,$qr,$re,$con);
?>