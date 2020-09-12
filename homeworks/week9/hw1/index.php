<?php
	session_start();

	require_once('conn.php');
	require_once('utils.php');

	// $username = NULL;
	// if(!empty($_COOKIE)){
	// 	$username = $_COOKIE['username'];
	// };
	$username = NULL;
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
	}

	// 記得移到最後執行，才不會被覆蓋
	$result = $conn->query('SELECT * FROM gaga_comments ORDER BY id DESC');
	if (!$result) {
		die('Error' . $conn->error);
	}
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
				<h1>留言板 Comments</h1>
				<div class="login__user">
					<p>你好！
						<span>
							<?php 
								echo $username;
							?>
						</span></p>
						<!-- 沒有 username 需顯示 button -->
						<?php if (!$username) { ?> 
							<button class="btn btn__login"><a href="login.php">登入</a></button>
							<button class="btn btn__register"><a href="register.php">註冊</a></button>
						<?php } else{ ?>
							<button class="btn btn__login"><a href="logout.php">登出</a></button>
						<?php } ?>
					
				</div>
			</div>
			<?php 
				if (!empty($_GET['errCode'])) {
					$msg ='Error';
					if ($_GET['errCode'] === '1') {
						$msg = '請輸入暱稱及留言！';
					}
					echo '<span>'. $msg .'</span>';
				}
			?>
			<!-- 有 username 需顯示留言區塊 -->
			<?php if ($username) { ?>
			<form class="board__block" method="POST" action="handle_add_post.php">
				<p>想說什麼呢？</p>
				<textarea name="content" rows="5" placeholder="請輸入文字..."></textarea>
				<input class="btn" type="submit" name="submit" value="送出">
				
			</form>
			<?php } else{ ?>
				<h3>請先登入會員!</h3>
			<?php } ?>
			<div class="hr"></div>
		</section>

		<section>
			<?php
				while ($row = $result->fetch_assoc()) {
				// print_r($row);
			?>
			<div class="user__block">
				<div class="user_photo"></div>
				<div class="user__content">
					<div class="user_infor">
						<div class="user__name">
							<?php echo $row['nickname'] ?>
						</div>
						<div class="user__time">
							<?php echo $row['created_at'] ?>
						</div>
					</div>
					<p class="user__text"><?php echo $row['content'] ?></p>
				</div>
			</div>
			<?php
				}
			?>
		</section>
	</main>
	
  <script src="https://kit.fontawesome.com/e66939fe7a.js" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>
</html>