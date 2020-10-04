<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');


	if (empty($_POST['content'])) {
		header('Location:add.php?errCode=1');
		die('請輸入標題及內容！');
	}
	
	$username = $_SESSION['username'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$user = getUserFromUsername($username);
	
  if (!$username || $user['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
  }
	$sql = "INSERT INTO gaga_w11_hw2_comments(username, title, content) VALUES(?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $username, $title, $content);
	$result = $stmt->execute();
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: admin.php');
?>