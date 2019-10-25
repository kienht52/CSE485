<?php
include 'connect.php';
if (isset($_GET['key'])&&($_GET['key']!=''))
{
	if ($_GET['key']=='xoa')
	{
		$sql="DELETE FROM users WHERE id=$_GET[id]";
	}
	if ($_GET['key']=='capquyen')
	{
		$sql="UPDATE users SET per=1  WHERE id=$_GET[id]";
	}
}

if (mysqli_query($con,$sql))
	{
		header('location:Manage.php');
	}
else echo "Lỗi khi thực hiện";  
?>