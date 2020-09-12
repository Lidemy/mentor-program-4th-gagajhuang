<?php
	require_once('conn.php');

	if (empty($_POST['nickname']) || empty($_POST['username']) || empty($_POST['password'])) {
		header('Location:register.php?errCode=1');
		die('請輸入資料！');
	}
	$nickname = $_POST['nickname'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = sprintf("INSERT INTO gaga_users(nickname, username, password) VALUES('%s', '%s' , '%s')", $nickname, $username, $password);
	// echo 'SQL:' . $sql . '<br>';
	$result = $conn->query($sql);

	// 顯示錯誤訊息
	if(!$result){
		$code = $conn->errno;
		if ($code === 1062) {
			header('Location:register.php?errCode=2');
		}
		die($conn->error);

		// if (strpos($conn->error, "Duplicate entry") !== false) {
		// 	header('Location:register.php?errCode=2');
		// }
		// die($conn->error);
	}
	header('Location: index.php');
?>