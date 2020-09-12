<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	if (empty($_POST['username']) || empty($_POST['password'])) {
		header('Location:login.php?errCode=1');
		die('請輸入資料！');
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = sprintf("SELECT * FROM gaga_users WHERE username='%s' AND password='%s'", $username, $password);

	$result = $conn->query($sql);
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	};

	if($result->num_rows){ // 當抓取資料有成功時(執行行數不為 0 )，
		// echo '登入成功';
		
		$_SESSION['username'] = $username;

		header('Location:index.php');
	}else{
		header('Location:login.php?errCode=2');
	}
?>