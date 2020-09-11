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
	$user = getUserFromUsername($_SESSION['username']);
	$nickname = $user['nickname'];
	
	$content = $_POST['content'];

	$sql = sprintf("INSERT INTO gaga_comments(nickname, content) VALUES('%s','%s')", $nickname, $content);
	echo 'SQL:' . $sql . '<br>';
	$result = $conn->query($sql);

	// 顯示錯誤訊息
	if(!$result){
		die($conn->error);
	}
	header('Location: index.php');
?>