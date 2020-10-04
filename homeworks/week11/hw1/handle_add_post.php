<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');


	if (empty($_POST['content'])) {
		// header('Location:index.php?errMsg=請輸入暱稱及留言！');
		header('Location:index.php?errCode=1');
		die('請輸入暱稱及留言！');
	}

	//利用 _SESSION 加入 nickname
	// $user = getUserFromUsername($_SESSION['username']);
	// $nickname = $user['nickname'];
	
	$username = $_SESSION['username'];
	$content = $_POST['content'];
	$user = getUserFromUsername($username);
	
	if ($user['role'] === 'Banned') {
		header('Location: index.php');
		exit;
	}
	// $sql = sprintf("INSERT INTO gaga_w11_hw1_comments(nickname, content) VALUES('%s','%s')", $nickname, $content);
	$sql = "INSERT INTO gaga_w11_hw1_comments(username, content) VALUES(?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $username, $content);
	$result = $stmt->execute();
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: index.php');
?>