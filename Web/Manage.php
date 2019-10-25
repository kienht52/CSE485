<?php
	include"connect.php";
    if (isset($_COOKIE['dangnhap']))
    {
        $us = $_COOKIE['dangnhap'];
        $qr = "select * from users where username='$us'";
        $re = mysqli_query($con,$qr);
        $row_per = mysqli_fetch_array($re);
        if ($row_per['per'] == 0)
        {
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
	<div class="text-center"><h1>QUẢN LÝ TÀI KHOẢN</h1></div>
		<table class="table">
			<tr id="table">
						<th width=10>ID</th>
						<th width=150>Tên tài khoản</th>
						<th width=40>Quyền đăng nhập</th>
						<th>Name</th>
						<th>Geder</th>
						<th>Email</th>
						<th>Address</th>
						<th width=20>Xóa</th>
						<th width=40>Cấp quyền</th>
					</tr>
<?php            
            $sql="select * from users WHERE username!='$us' and per!='0'";
            $re = mysqli_query($con,$sql);
            while($r=mysqli_fetch_array($re))
            {
                echo "<tr><td>$r[id]</td>";
                echo "<td>$r[username]</td>";
                if ($r['per']==1)
                {
                    echo "<td>ADMIN</td>";
                }
                else echo "<td>USER</td>";
                echo "<td>$r[name]</td>";
                if ($r['gender']==0){
                    echo "<td>Nam</td>";
                }
                else echo "<td>Nữ</td>";
                echo "<td>$r[email]</td>";
                echo "<td>$r[address]</td>";
                echo "<td><a href='#' onclick='xoa()'>"."<i class='fas fa-trash'></i></a></td>";
?>
				<script type="text/javascript">
				    function xoa()
                    {
					    var r=confirm("Bạn chắc xóa tài khoản <?php echo $r['username'];?> chứ!!")
					    if(r==true)
                        {
						    window.location="Perform.php?id=<?php echo $r['id'];?>&key=xoa";
					    }
				        }
				</script>
<?php 
				echo "<td><a href='#' onclick='capquyen()'>"."<i class='fas fa-id-card'></i></a></td></tr>";
?>
				<script type="text/javascript">
				    function capquyen()
                    {
				        var r=confirm("Bạn chắc cấp quyền ADMIN cho tài khoản <?php echo $r['username'];?> chứ!!")
					    if(r==true)
                        {
						    window.location="Perform.php?id=<?php echo $r['id'];?>&key=capquyen";
					    }
					    }
                </script>
<?php 
            }
?>

        </table>
    </div>
    <div class="row justify-content-end bott">
        <a href="Admin.php"><i class="fas fa-undo-alt"></i></a>
    </div>
</body>
</html>
<?php
			}
			
			else 
				header('location:./Admin.php');
		}
		else header('location:./Login.php');
?>