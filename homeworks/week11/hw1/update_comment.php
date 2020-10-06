<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	$username = NULL;
	$user = NULL;
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$user = getUserFromUsername($username);
	}

	$id = $_GET['id'];
	$stmt = $conn->prepare('SELECT * FROM gaga_w11_hw1_comments WHERE id = ?');
	$stmt->bind_param('i', $id);

	$result = $stmt->execute();
	if (!$result) {
		die('Error' . $conn->error);
	}
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();// 取出內容
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>留言板</title> 
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<header class="attation__block">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號密碼。</header>
	<main>
		<section>
			<div class="login__block">
				<h1>編輯留言</h1>
			</div>
			<?php 
				if (!empty($_GET['errCode'])) {
					$msg ='Error';
					if ($_GET['errCode'] === '1') {
						$msg = '資料不齊全！';
					}
					echo '<h3>'. $msg .'</h3>';
				}
			?>
			<?php if ($username) { 
			?>
			<form class="board__block" method="POST" action="handle_update_comment.php">
				<textarea name="content" rows="5" placeholder="請輸入文字..."><?php echo $row['content']?></textarea>
				<input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
				<input class="btn" type="submit" name="submit" value="送出">
			</form>
			<?php } ?>
		</section>
	</main>
	
  <script src="https://kit.fontawesome.com/e66939fe7a.js" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>
</html>