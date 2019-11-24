<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>1760037_N.T.H.Dung_LTWeb1-PHP & From</title>

  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand"style="font-family:Georgia"><strong>LẬP TRÌNH WEB 1</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo $page == 'index' ? 'active' : ' ' ?>">
              <a class="nav-link" href="index.php" style="font-family:Georgia"><strong>Home</strong></a>
            </li>
            <?php if(!$currentUser): ?> 
            <li class="nav-item <?php echo $page == 'registrer' ? 'active' : ' ' ?>">
              <a class="nav-link" href="registrer.php" style="font-family:Georgia"><strong>Đăng Ký</strong></a>
            </li>                    
            <li class="nav-item <?php echo $page == 'login' ? 'active' : ' ' ?>">            
              <a class="nav-link" href="login.php" style="font-family:Georgia"><strong>Đăng Nhập</strong></a>
            </li>
            <?php else: ?>            
            <li class="nav-item <?php echo $page == 'updateProfile' ? 'active' : ' ' ?>">            
              <a class="nav-link" href="updateProfile.php" style="font-size:95%;font-family:Georgia"><strong><?php echo $currentUser ? ' ' . $currentUser[0]['FullName'] . ' ' : ' ' ?></strong></a>
            </li>
            <li class="nav-item <?php echo $page == 'changePassword' ? 'active' : ' ' ?>">            
              <a class="nav-link" href="changePassword.php" style="font-size:95%;font-family:Georgia"><strong>Đổi Mật Khẩu</strong></a>
            </li>
            <li class="nav-item <?php echo $page == 'logout' ? 'active' : ' ' ?>">
              <a class="nav-link" href="logout.php" style="font-size:95%;font-family:Georgia"><strong>Đăng Xuất <?php echo $currentUser ? '(' . $currentUser[0]['FullName'] . ')' : ' ' ?></strong></a>
            </li>
            <?php endif; ?>       
        </div>
      </nav>