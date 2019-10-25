<?php
	session_start();
	include("connect.php");
	if (isset($_COOKIE['dangnhap']))
	{
        $sql="select * from users where username='".$_COOKIE['dangnhap']."'";
        $qr=mysqli_query($con,$sql);
        $re=mysqli_fetch_array($qr);   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="./img/logo.jpg">
    <title>Admin</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
		<h1>Trang Quản Trị</h1>
	</div>
	<div class="row menu">
		<nav class="navbar">
<?php
	if ($re['per']==0)
	{
			echo "<a href='Manage.php'>"."<i class='fas fa-users-cog'></i> Quản lý tài khoản</a>";
			echo "<a href='Edit.php'>"."<i class='fas fa-folder-plus'></i> Thêm tin tức</a>";
	}
	if ($re['per']==1)
	{
			echo "<a href='Edit.php'>"."<i class='fas fa-folder-plus'></i> Thêm tin tức</a>";
	}
?>
			<a href="Logout.php"><i class="fas fa-power-off"></i> Đăng xuất</a>
		</nav>
				

	</div>
	<div class="row h2">
		<h2>Xin chào <?php echo $_COOKIE['dangnhap']; ?>!</h2>
	</div>
</div>
    
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

</body>
</html>
<?php
	}
	else
	{ 
		header("location:./Login.php");
	}
?>