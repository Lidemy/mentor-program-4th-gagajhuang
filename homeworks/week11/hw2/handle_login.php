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

	$sql = "SELECT * FROM gaga_w11_hw2_users WHERE username=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $username);
	$result = $stmt->execute();
	// $result = $conn->query($sql);
	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	};

  //要加這段才會把結果拿回來
  $result = $stmt->get_result();

	if($result->num_rows === 0){
		header('Location:login.php?errCode=2');
		exit();
	}

	// 有查到使用者
	$row = $result->fetch_assoc();
	if(password_verify($password, $row['password'])){
		$_SESSION['username'] = $username;
		header('Location:index.php');
	}else{
		header('Location:login.php?errCode=2');
	}
?>