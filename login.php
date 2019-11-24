<?php 
  require_once 'init.php';
  
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
		  	background-image: url("https://static.wixstatic.com/media/5615fa_d07bf8507f524bc6b8cabc7cb7bc0919~mv2.gif"),url("https://img5.goodfon.com/wallpaper/nbig/5/58/bloknot-ruchka-kofe-tsvety.jpg");}
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
		a { font-size:100%;font-weight:bold;font-family: Times New Roman;};
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family:Georgia">Đăng Nhập</h1>
		<?php if (isset($_POST['Email']) && isset($_POST['Password'])): ?>
		<?php 
			$Email = $_POST['Email'];
			$Password = $_POST['Password'];
			$success = false;
			
			$user = findUserByEmail($Email);
		
			if ($user && $user[0]['status'] == 1 && password_verify($Password, $user[0]['password']))
			{
				$success = true;
				$_SESSION ['userID'] = $user[0]['id'];
			}
		?>
		<?php if ($success): ?>
		<?php header('Location: index.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Đăng nhập Không thành công!!Mời đăng nhập lại :)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form action="login.php" method="POST">
			<div class="form-group">
				<label for="Email"><strong>Email</strong></label>
				<input type="email" class="form-control" id="Email" placeholder="Nhập Email" name="Email">
			</div>
			<div class="form-group">
				<label for="Password"><strong>Password</strong></label>
				<input type="password" class="form-control" id="Password" placeholder="Nhập Password" name="Password">
			</div>			
			<button type="Submit" class="btn btn-success"><b>Log In</b></button>
			<a href="forgotPassword.php">Quên Mật Khẩu?</a>
		</form>
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/HsVRhIfGJMpM" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>