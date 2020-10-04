<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	if (empty($_POST['content'])) {
		header('Location:edit.php?errCode=1&id='. $_POST['id']);
		print_r($_POST['id']);

		die('資料不齊全！');
	}

	$username = $_SESSION['username'];
	$id = $_POST['id'];
	$content = $_POST['content'];
	$user = getUserFromUsername($username);

	if($user['role'] === 'Admin'){
		$sql = "UPDATE gaga_w11_hw2_comments SET content=? WHERE id=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('si', $content, $id);
	}

	$result = $stmt->execute();

	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: edit.php?id='. $_POST['id']);
?>