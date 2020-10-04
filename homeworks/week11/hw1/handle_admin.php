<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');
 	// print_r($_POST['role']); // 抓取 select name

	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$user = getUserFromUsername($username);
	}
  
  // 使用者不等於 "空" 或不等於 admin
	if ($user === NULL || $user['role'] !== 'Admin') {
		header('Location: index.php');
		exit;
	}
	if (empty($_POST['role'] || $_POST['id'])) {
		header('Location: admin.php');
		exit;
	}
	$id = $_POST['id'];
	$role = $_POST['role'];
	print_r($role);
	$sql = "UPDATE gaga_w11_hw1_users SET role=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('si', $role, $id);

	$result = $stmt->execute();

	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: admin.php');
?>