<?php
require_once 'init.php';
  if (!$currentUser)
  {
  	header('location: index.php');
  	exit();
  }

  $content = $_POST['content'];

  createPosts($currentUser[0]['id'], $content);

  header('location: index.php');
?>