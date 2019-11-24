<?php 
  require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: index.php');
  	exit();
  }
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đổi Mật Khẩu</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
		  	background-image:url("https://taiphanmem.net/wp-content/uploads/2018/01/hinh-nen-powerpoint-don-gian-ma-dep.jpg");}
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family:Georgia">Đổi Mật Khẩu</h1>
		<?php if (isset($_POST['oldpassword']) && isset($_POST['Password'])): ?>
		<?php
			$oldpassword = $_POST['oldpassword'];
			$Password = $_POST['Password'];
			

			$success = false;
		
			if (password_verify($oldpassword, $currentUser[0]['password']))
			{
				updatePassword($currentUser[0]['id'], $Password);
				$success = true;
			}
		?>
		<?php if ($success): ?>
		<?php header('Location: index.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Đổi Mật Khẩu Thất Bại:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="changePassword.php" method="POST">
			<div class="form-group">
				<label for="oldpassword"><strong>Mật Khẩu Cũ</strong></label>
				<input type="text" class="form-control" id="oldpassword" placeholder="Nhập mật khẩu hiện tại" name="oldpassword">
			</div>
			<div class="form-group">
				<label for="Password"><strong>Mật khẩu Mới</strong></label>
				<input type="text" class="form-control" id="Password" placeholder="Nhập mật khẩu mới" name="Password">
			</div>			
			<button type="Submit" class="btn btn-success"><b>Đổi Mật Khẩu</b></button>
			<button type="Reset" class="btn btn-primary"><b>Reset</b></button>	
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/Ac9TWm0PDtyO" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>