<?php 
  	require_once 'init.php';
  	$success = false;	
	$user =null;
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Password Mới</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
		  	background-image: url("https://img1.picmix.com/output/stamp/normal/7/9/4/0/270497_860df.gif"),url("https://trahoahong.files.wordpress.com/2011/10/nice-white-flowers_wallpapers_8797_1024x768.jpg");}
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family:Georgia"></h1>
		<?php if (isset($_POST['code']) &&  isset($_POST['newPassword'])): ?> 
		<?php
			$code_input =$_POST['code'];
			$new_password = $_POST['newPassword'];
			$Email=$_SESSION['Email'];
			$user=findUserByEmail($Email);
			$ID=FindIDUserByEmail($Email);
			if($user != null)
			{
				if(CheckingAuthCodeByEmail($code_input,$Email))
				{
					updatePassword($ID, $new_password);
					$success = true;
				}				
			}
		?>
		<?php if ($success): ?>
		<div class="alert alert-success" role = "alert">
			<?php header('Location: login.php'); ?>
		</div>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Lấy Lại Password Không Thành Công !!
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="newPassword.php" method="POST">
			<div class="form-group">
				<label for="code"><strong>Mã Kích Hoạt</strong></label>
				<input type="text" class="form-control" id="code" placeholder="Nhập code" name="code">
			</div>
			<div class="form-group">
				<label for="newPassword"><strong>New Password</strong></label>
				<input type="Password" class="form-control" id="newPassword" placeholder="Nhập Password mới" name="newPassword">
			</div>
			
			<button type="Submit" class="btn btn-success"><b>Hoàn Thành</b></button>
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/qUt5RmNHF4Ct" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>