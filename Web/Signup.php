<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./img/logo.jpg">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/sign.css">
</head>
<body>
    <div class="form">
        <form class="form-group" action="" method="post">
            <div class="icon"><i class="fas fa-user-plus"></i></div>
            <input id="input" class="form-control" type="text" name="userdk" placeholder="Username" required>
            <input id="input" class="form-control" type="email" name="emaildk" placeholder="Email" required>
            <input id="input" class="form-control" type="email" name="emailre" placeholder="Email (repeat)" required>
            <input id="input" class="form-control" type="password" name="passdk" placeholder="Password" required>
            <input id="input" class="form-control" type="password" name="passre" placeholder="Password (repeat)" required>
            <input id="input" class="form-control" type="text" name="name" placeholder="Full Name">
            <div class="form-check-inline gender">Giới tính:&nbsp
                <label class="form-check-label">&nbsp
                    <input type="radio" class="form-check-input" name="radio" value="0">Nam
                    <input type="radio" class="form-check-input" name="radio" value="1">Nữ
                </label>
            </div>
            <input id="input" class="form-control" type="text" name="addr" placeholder="Address">
            <button class="btn btn-primary btn-block" type="submit" name="dangky" >Sign Up</button>
            <div id="row">
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
    if (isset($_POST["dangky"]))
    {
        if ($_POST['emaildk']==$_POST['emailre'])
        {
            if ($_POST['passdk']==$_POST['passre'])
            {
                $us = $_POST['userdk'];
                $em = $_POST['emaildk'];
                $ps = password_hash($_POST['passdk'], PASSWORD_DEFAULT);
                $na = $_POST['name'];
                $ge = $_POST['radio'];
                $ad = $_POST['addr'];
                $qr = "select username from users where username='$us' or email='$em'";
                $re = mysqli_query($con,$qr);
                if (mysqli_fetch_array($re)==0)
                {
                    $sql = "INSERT INTO users(id,username,email,pass,name,gender,address,per) VALUES ('','$us','$em','$ps','$na','$ge','$ad','2')";
                    if (mysqli_query($con, $sql))
                    {                        
                        $subject = "Signup Successful";
                        $txt = "Bạn đã đăng ký thành công tài khoản: " . $us;
                        $headers = "From: admin@admin";
                        mail($em,$subject,$txt,$headers);
                        header("location:./Success.php");
                    }
                    else
                    {
                        echo "<script>alert('Xảy ra lỗi " . mysqli_error($con) . "')</script>";
                    }
                }
                else
                {
                    echo "<script>alert('Đã có tài khoản này')</script>";
                }
            }
            else
            {
                echo "<script>alert('2 mật khẩu không trùng nhau')</script>";
            }
        }
        else
        {
            echo "<script>alert('2 email không trùng nhau')</script>";
        }
    }
    mysqli_close($con);
?>