<?php
	include"connect.php";
    if (isset($_COOKIE['dangnhap']))
    {
        $us = $_COOKIE['dangnhap'];
        $qr = "select * from users where username='$us'";
        $re = mysqli_query($con,$qr);
        $row_per = mysqli_fetch_array($re);
        if ($row_per['per'] != 2)
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
	<script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.form.js"></script>
</head>
<body>
	<br>
	<div class="panel panel-default">
		<div class="panel-body">
			<h2 style="text-align:center">Trang thêm tin tức</h2>
			<form id="uploadImage" action="Upload.php" method="post">
				<div class="form-group">
					<label>File Image</label>
					<input type="file" name="uploadFile" id="uploadFile" accept=".jpg, .png"  />
				</div>
				<div class="form-group">
					<input type="submit" id="uploadSubmit" value="Up image" class="btn btn-info" style="text-align:center; width:100px; height:35px;">
				</div>
				<div class="progress">
					<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<div id="targetLayer" style="display:none;"></div>
			</form>
			<form>
				<input type="text" name="uimage" id="uimage"/>
			</form>
			<div id="loader-icon" style="display:none;"><img src="upload/loader.gif" /></div>
			<div>
				<b>Link:</b><span class="batbuoc">*</span>
				<input type="text" name="link" placeholder="link image" size=50px>
			</div>
			<p>
				<b>Text:</b>
				<span class="batbuoc">*</span>
				<textarea style="width:100%; height:100px;" name="mota"></textarea>
			</p>
			<p>
				<input type="submit" name="submit_all" value="Update" class="btn btn-info" style="text-align:center; width:100px; height:35px">
			</p>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#uploadImage').submit(function(event){
				var target = $("#targetLayer").html();
				if($('#uploadFile').val())
				{
					event.preventDefault();
					$('#loader-icon').show();
					$('#targetLayer').hide();
					$(this).ajaxSubmit({
						target: '#targetLayer',
						beforeSubmit:function(){
							$('.progress-bar').width('50%');
						},
						uploadProgress: function(event, position, total, percentageComplete)
						{
							$('.progress-bar').animate({
								width: percentageComplete + '%'
							}, {
								duration: 1000
							});
						},
						success:function(){
							$('#loader-icon').hide();
							target = target+$('#targetLayer').html();
							$('#targetLayer').html(target);
							$('#uimage').val("/Test2310/"+ $(target).attr("src"))
							$('#targetLayer').show();
						},
						resetForm: true
					});
				}
				return false;
			});
		});
	</script>
<?php
	if(isset($_POST['submit_all'])){
		$i=0;
		$_error[$i]='';
		if(isset($_POST['uimage'])&&$_POST['uimage']!=null){
			$uimage=$_POST['uimage'];
		}else{
			$i++;
			$_error[$i] = "Bạn chưa chọn ảnh";
		}
		if(isset($_POST['link'])&&$_POST['link']!=null){
			$link=$_POST['link'];
		}else{
			$i++;
			$_error[$i] = "Bạn chưa nhập tiêu đề ảnh";
		}
		if(isset($_POST['mota'])&&$_POST['mota']!=null){
			$mota=$_POST['mota'];
		}else{
			$i++;
			$_error[$i] = "Bạn chưa nhập thông tin ảnh";
		}
		if ($_POST['uimage']!=null&&$_POST['link']!=null&&$_POST['mota']!=null&&$_COOKIE['dangnhap']!=null){
			$sql="INSERT INTO news (idp, username, link, mota, img) VALUES ('', N'".$_COOKIE['dangnhap']."', N'$link', N'$mota', N'$uimage')";
			if (mysqli_query($con,$sql)){
				echo "<script language='javascript' type='text/javascript' >";
				echo "alert('Thêm slider thành công');";    
				echo "</script>";
			}else{
				$i++;
				$_error[$i] = "Lỗi khi INSERT $link:".mysqli_error($con)."<br>";
			}
		}
		if($i!=0){
			echo "<script language='javascript' type='text/javascript' >";
			echo "alert('";
			foreach ($_error as $loi){
				echo $loi.'\n';
			}
			echo"');";    
			echo "</script>";
		}
	}
}	
}
else{ 
	echo "<script language='javascript' type='text/javascript' >";
	echo "alert('Bạn chưa đăng nhập quay lại đăng nhập!!!');";    
	echo "</script>";
	header("location:./index.php");
}
?>
</body>
</html>