<?php 
  require_once 'init.php';
  
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kích Hoạt Tài Khoản</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
		  	background-image: url("https://static.wixstatic.com/media/5615fa_d07bf8507f524bc6b8cabc7cb7bc0919~mv2.gif"),url("https://img5.goodfon.com/wallpaper/nbig/5/58/bloknot-ruchka-kofe-tsvety.jpg");}
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family:Georgia">Kích Hoạt Tài Khoản</h1>
		<?php if (isset($_GET['code'])): ?>
		<?php 
			$code = $_GET['code'];
			$success = false;
			
			$success = activeUser($code);
		?>
		<?php if ($success): ?>
		<?php header('Location: login.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Kích hoạt tài khoản không thành công!
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form method="GET">
			<div class="form-group">
				<label for="code"><strong>Mã Kích Hoạt</strong></label>
				<input type="text" class="form-control" id="code" placeholder="Nhập code" name="code">
			</div>			
			<button type="Submit" class="btn btn-success"><b>Kích hoạt tài khoản</b></button>
			<button type="Reset" class="btn btn-primary"><b>Reset</b></button>	
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/HsVRhIfGJMpM" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>