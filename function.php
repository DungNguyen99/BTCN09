<?php

require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function detectPage(){
	$uri = $_SERVER ['REQUEST_URI'];
	$parts = explode('/', $uri);
	$fileName = $parts[2];
	$parts = explode('.',$fileName);
	$page = $parts[0];
	return $page;
}

function findUserByEmail($email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM user WHERE Email = ?");
	$stmt->execute(array($email));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
function FindIDUserByEmail($Email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM user U WHERE U.Email = ?");
	$stmt->execute(array($Email));
	$ID = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	return $ID[0]['id'];

}
function findUserById($id)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM user WHERE id = ?");
	$stmt->execute(array($id));
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function createUser($FullName, $Email, $password)
{
	global $db, $BASE_URL;
	$hashPassword = password_hash($password, PASSWORD_DEFAULT);
	$code = generateRandomString(16);
	$stmt = $db ->prepare("INSERT INTO user (FullName, Email, Password, status, code, phoneNumber, avatar) VALUES (?,?,?,?,?,?,?)");
	$stmt->execute(array($FullName, $Email,$hashPassword, 0, $code,'', ''));
	$id =  $db->lastInsertID();
	sendEmail($Email, $FullName, 'Kích hoạt tài khoản', "Mã kích hoạt tài khoản của bạn là <a href =\"$BASE_URL/activeUser.php?code=$code\">
		$BASE_URL/activeUser.php?code=$code</a>");
	return $id;
}

function forgotPass($Email)
{
	global $db, $BASE_URL;
	$code = generateRandomString(15);
	$stmt = $db ->prepare("UPDATE user SET code = ? WHERE Email = ?");
	$stmt->execute(array($code, $Email));
	sendEmail($Email, 'lấy lại mật khẩu','Mã kích lấy lại mật khẩu của bạn', "mã của bạn là : <h2>$code</h2> <p>hãy dùng mật khẩu này đổi mật khẩu </p>");
}
	
function updatePassword($id, $Password)
{
	global $db;
	$hashPassword = password_hash($Password, PASSWORD_DEFAULT);
	$stmt = $db ->prepare("UPDATE user SET password = ? WHERE id = ?");
	return $stmt->execute(array($hashPassword, $id));
}

function updateUserProfile($id, $fullname, $phoneNumber)
{
	global $db;
	$stmt = $db ->prepare("UPDATE user SET FullName = ?, phoneNumber = ?WHERE id = ?");
	return $stmt->execute(array($fullname, $phoneNumber, $id));
}

function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}

function getNewFeeds()
{
	global $db;
	$stmt = $db ->query("SELECT p.*, u.FullName FROM posts AS p JOIN user AS u ON p.userID = u.id ORDER BY p.createAt DESC");
	return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}

function createPosts($userid, $content)
{
	global $db;
	$stmt = $db ->prepare("INSERT INTO posts (content, userID) VALUES (?,?)");
	$stmt->execute(array($content, $userid));
	return $db->lastInsertID();
	
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($to, $name, $subject, $content)
{
	global $EMAIL_FROM, $EMAIL_NAME, $EMAIL_PASSWORD;
	// Instantiation and passing `true` enbles exceptions
	$mail = new PHPMailer(true);
		//Server settings
	
	// Enable verbose debug output
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	// Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                // Enable SMTP authentication
	$mail->Username   = $EMAIL_FROM;                     // SMTP username
	$mail->Password   = $EMAIL_PASSWORD;                               // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	$mail->Port       = 587;
	// TCP port to connect to

	    //Recipients
	$mail->setFrom($EMAIL_FROM, $EMAIL_NAME);
	$mail->addAddress($to, $name);     // Add a recipient    

	// Content
	$mail->isHTML(true);
	// Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body    = $content;
	//$mail->AltBody = $content;

	$mail->send();    
}

function activeUser($code)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM user WHERE code = ? and status = ?");
	$stmt->execute(array($code, 0));
	$user = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	if($user && $user[0]['code'] == $code)
	{
		$stmt = $db ->prepare("UPDATE user SET code = ?, status = ? WHERE id = ?");
		$stmt->execute(array('', 1, $user[0]['id']));
		return true;
	}
	return false;
}

function CheckingAuthCodeByEmail($code,$Email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM user WHERE code = ? and Email = ?");
	$stmt->execute(array($code, $Email));
	$user = $stmt -> fetchAll(PDO::FETCH_ASSOC);
	if($user && $user[0]['code'] == $code)
	{
		return true;
	}
	return false;
}
?>