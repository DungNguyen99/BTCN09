<?php 
  require_once 'init.php';
  
  $posts = getNewFeeds();
?>
<?php include 'header.php'; ?>
<h1 style="color:red; font-family:Georgia" ><marquee behavior="alternate" direction="up" width="80%"><marquee direction="right" behavior="alternate"><b>-*-*-Chào mừng bạn đến với lớp học Lập Trình Web 1 _17CK1-*-*-</b></marquee></marquee></h1>
<style>
		body {
		  	background-image: url("https://media.giphy.com/media/fo2dhRTmaULbStoFkX/giphy.gif");
		  	}
</style>
<strong><em><center style="color:blue;font-family:Palatino Linotype;font-size: 130%">Nếu bạn không lập trình chính mình.Cuộc sống sẽ lập trình bạn !!</center></em></strong>
<p><iframe src="https://www.nhaccuatui.com/mh/background/ZubgiLhQCeSI" width="1" height="1" frameborder="0" allowfullscreen allow="autoplay"></iframe></p>

<?php if ($currentUser): ?>
<p><strong>Chào mừng <?php echo $currentUser[0]['FullName']; ?> đã trở lại</strong> </p>
<form action="status.php" method="POST">
	<div class="form-group">
		<label for="content"><strong>Thêm Trạng Thái</strong></label>
		<textarea class="form-control" id="content" name="content" rows="3" placeholder="Bạn đang nghĩ gì"></textarea>
	</div>					
	<button type="Submit" class="btn btn-success"><b>Đăng</b></button>
	<button type="Reset" class="btn btn-primary"><b>Reset</b></button>	
</form>
<div class="row">
<?php foreach ($posts as $posts): ?>
<div class="col-sm-12">
	<div class="card">
	  <div class="card-body">
	    <h5 class="card-title">
	    	
	    	<img style="width:90px" class="card-img-top" src="avatars/<?php echo $posts['userID'].'.'.'jpg'?>">
	    		    	<?php echo $posts['FullName']; ?>
	    </h5>
	    <h6 class="card-subtitle mb-2 text-muted"><?php echo $posts['createAt']; ?></h6>
	    <p class="card-text">
	    	<?php echo $posts['content']; ?>    		
	    </p>
	  </div>
	</div>
</div>
<?php endforeach ?>
<?php else: ?>
<?php endif; ?>
<?php include 'footer.php'; ?>
