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
	<title>Thông Tin Cá Nhân</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		body {
		  	background-image:url("http://4.bp.blogspot.com/-YrFLeW3pu0E/Uu8vu2pUbPI/AAAAAAAABlY/X1EfUQwLWP4/s1600/anh-tinh-yeu-dep.png");}
		input[type=text] {width: 60%;}
		label {font-size: "2"; font-family: Times New Roman;}
	</style>
</head>
<body>
	<div class="container">
		<h1 style="font-family:Georgia">Cập Nhật Thông Tin Cá Nhân</h1>
		<?php if (isset($_POST['FullName']) && isset($_POST['phoneNumber'])): ?>
		<?php
			$FullName = $_POST['FullName'];
			$phoneNumber = $_POST['phoneNumber'];

			$success = false;
		
			if ($FullName != '')
			{
				updateUserProfile($currentUser[0]['id'], $FullName, $phoneNumber);
				$success = true;
			}
			
			if (isset($_FILES['avatar']))
			{
				$success = false;
				$file = $_FILES['avatar'];
				$fileName = $file['name'];
				$fileSize = $file['size'];
				$fileTemp = $file['tmp_name'];
				$filePath = './avatars/' . $currentUser[0]['id'] . '.jpg';
				$success = move_uploaded_file($fileTemp, $filePath);
				$newImage = resizeImage($filePath, 200, 200);
				imagejpeg($newImage, $filePath);
				//SaveImage($file);
			}
		?>
		<?php if ($success): ?>
		<?php header('Location: index.php'); ?>
		<?php else: ?>
		<div class="alert alert-danger" role = "alert">
			Cập Nhật Thông Tin Thất Bại:)
		</div>
		<?php endif; ?>
		<?php else: ?>
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="FullName"><strong>Họ Tên</strong></label>
				<input type="text" class="form-control" id="FullName" name="FullName" placeholder="Tên của bạn" value="<?php echo $currentUser[0]['FullName']; ?>">
			</div>
			<div class="form-group">
				<label for="phoneNumber"><strong>Số Điện Thoại</strong></label>
				<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Số điện thoại của bạn">
			</div>
			<div class="form-group">
				<label for="avatar"><strong>Ảnh Đại Diện</strong></label><br>
				<input type="file" class="file" id="avatar" name="avatar">
			</div>			
			<button type="Submit" class="btn btn-success"><b>Cập Nhật TTCN</b></button>
			<button type="Reset" class="btn btn-primary"><b>Reset</b></button>	
		</form>
	</div>
</body>
</html>
<?php endif; ?>
<p><iframe src="https://www.nhaccuatui.com/mh/background/dkE0hFCviG1g" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>
<?php include 'footer.php'; ?>