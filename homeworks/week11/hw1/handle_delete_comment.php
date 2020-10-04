<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	if (empty($_GET['id'])) {
		header('Location:update_comment.php?errCode=1');
		die('資料不齊全！');
	}

	$id = $_GET['id'];
	$username = $_SESSION['username'];
	$user = getUserFromUsername($username);

	// $sql = "DELETE FROM gaga_w11_hw1_comments WHERE id=?"; 此為直接刪除資料庫
	$sql = "UPDATE gaga_w11_hw1_comments SET is_deleted=1 WHERE id=? AND username=?"; // 此為刪除畫面而已

	$stmt = $conn->prepare($sql);
	if($user['role'] === 'Admin'){
		$sql = "UPDATE gaga_w11_hw1_comments SET is_deleted=1 WHERE id=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('i', $id);
	}else{
		$stmt->bind_param('is', $id, $username);
	}

	$result = $stmt->execute();
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: index.php');
?>