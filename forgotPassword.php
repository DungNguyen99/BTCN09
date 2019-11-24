<?php 
  require_once 'init.php';
  
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lấy lại Mật Khẩu</title>
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
		<h1 style="font-family:Georgia">Quên Mật Khẩu</h1>
		<?php if (isset($_POST['Email'])): ?> 
		<?php // && isset($_POST['Password'])
			$Email = $_POST['Email'];
			//$Password = $_POST['Password'];
			//$hashPassword = password_hash($Password, PASSWORD_DEFAULT);
			// D check mail thử xemk
			$success = false;	
			$user =null;		
			$user = findUserByEmail($Email);			
			if ($user !=null)
			{
				$_SESSION['Email']=$Email;
				forgotPass($Email);
				// $_SESSION['userID'] = $newUserID;
				$success = true;
			}
		?>
		<?php if ($success): ?>
		<div class="alert alert-success" role = "alert">
			Vui lòng kiểm tra <strong>Email</strong> để lấy mật khẩu mới của tài khoản
			<?php header('Location: newPassword.php'); ?>
		</div>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Email không tồn tại, Không thành công!!:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="forgotPassword.php" method="POST">
			<div class="form-group">
				<label for="Email"><strong>Email</strong></label>
				<input type="text" class="form-control" id="Email" placeholder="Nhập Email" name="Email">
			</div>
			
			<button type="Submit" class="btn btn-success"><b>Lấy lại Mật Khẩu</b></button>
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/qUt5RmNHF4Ct" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>