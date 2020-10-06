<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	if (empty($_GET['id'])) {
		header('Location:handle_delete_comment.php?errCode=1');
		die('資料不齊全！');
	}

	$id = $_GET['id'];
	$username = $_SESSION['username'];
	$user = getUserFromUsername($username);

	// $sql = "DELETE FROM gaga_w11_hw1_comments WHERE id=?"; 此為直接刪除資料庫
	
	// if($user['role'] === 'Admin'){
		
	// }
	$stmt = $conn->prepare("UPDATE gaga_w11_hw2_comments SET is_deleted=1 WHERE id=?");
	$stmt->bind_param('i', $id);
	$result = $stmt->execute();
	
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: admin.php');
?>