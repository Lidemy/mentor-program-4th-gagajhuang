<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');

	$username = NULL;
	$user = NULL;
	if (!empty($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$user = getUserFromUsername($username); // username, id, nickname, role
	}

	// 分頁功能
	$page = 1;
	if (!empty($_GET['page'])) {
		$page = intval($_GET['page']); // string -> int
	}
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;

	// $stmt = $conn->prepare('SELECT * FROM gaga_w11_hw1_comments LEFT JOIN gaga_w11_hw1_users ON gaga_w11_hw1_comments.username = gaga_w11_hw1_users.username ORDER BY gaga_w11_hw1_comments.id DESC');

	$stmt = $conn->prepare('SELECT C.id AS id, C.content AS content, C.created_at AS created_at, U.nickname AS nickname, U.username AS username FROM gaga_w11_hw1_comments AS C LEFT JOIN gaga_w11_hw1_users AS U ON C.username = U.username WHERE C.is_deleted IS NULL ORDER BY C.id DESC LIMIT ? OFFSET ?');
	$stmt->bind_param('ii', $items_per_page, $offset);
	$result = $stmt->execute();

	if (!$result) {
		die('Error' . $conn->error);
	}
	$result = $stmt->get_result();

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
					<!-- 沒有 username 需顯示 button -->
					<?php if (!$username) { ?> 
						<button class="btn btn__login"><a href="login.php">登入</a></button>
						<button class="btn btn__register"><a href="register.php">註冊</a></button>
					<?php } else{ ?>
						<p>你好！
							<span>
								<?php 
									echo escape($user['nickname']);
								?>
							</span>
						</p>
						<button class="btn btn__login"><a href="logout.php">登出</a></button>
						<div class="btn change__nickname">編輯暱稱</div>
						<?php if ($user['role'] === 'Admin') { ?>
							<div class="btn manager__page"><a href="admin.php">會員管理</a></div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<?php if ($username) { ?> 
				<form method="POST" action="update_user.php" class="hide nickname__update">
					<div class="input__block">輸入新的暱稱：<input type="text" name="nickname"></div>
					<input class="btn" type="submit" name="submit" value="更新暱稱">
				</form>
			<?php } ?>
			<?php 
				if (!empty($_GET['errCode'])) {
					$msg ='Error';
					if ($_GET['errCode'] === '1') {
						$msg = '資料不齊全！';
					}
					echo '<h3>'. $msg .'</h3>';
				}
			?>
			<?php if ($username && !hasPermission($user, 'create', NULL)) { ?>
				<p>您已被停權發言！</p>
			<?php } else if ($username) { ?>
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
				<div class="user__left">
					<div class="user_photo"></div>
					<div class="user__content">
						<div class="user_infor">
							<div class="user__name">
								<?php echo escape($row['nickname']) ?>
								(@<?php echo escape($row['username']) ?> )
							</div>
							<div class="user__time">
								<?php echo escape($row['created_at']) ?>
							</div>
						</div>
						<div class="user__text"><?php echo escape($row['content']) ?></div>
					</div>
				</div>
				<?php 
					// if (!empty($_SESSION['username'])) {
						if (hasPermission($user,'update', $row)) { 
				?>
					<div class="btn__user">
						<a class="btn-update"href="update_comment.php?id=<?php echo $row['id']?>">編輯</a>
						<a class="btn-delete" href="handle_delete_comment.php?id=<?php echo $row['id']?>">刪除</a>
					</div>
				<?php 
						// }
					}
				?>
			</div>
			<?php
				}
			?>
			<div class="hr"></div>
		</section>
		<section class="page__block">
			<?php 
				$stmt = $conn->prepare('SELECT COUNT(id) AS count FROM gaga_w11_hw1_comments WHERE is_deleted IS NULL');
				$result = $stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				// print_r($row);
				
				$count = $row['count'];
				$total_page = intval(ceil($count / $items_per_page)); // 無條件進位
				// echo gettype($total_page);
			?>
			<div>
				<span>總共有 <?php echo $count ?> 筆留言，</span>
				<span>目前頁數：<?php echo $page ?> / <?php echo $total_page ?></span>
			</div>
			<div class="page__list">
				<?php if ($page !== 1) { ?>
					<a href="index.php?page=1">首頁</a>
					<a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
				<?php } ?>
				<?php if ($page !== $total_page) { ?>
					<a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
					<a href="index.php?page=<?php echo $total_page ?>">最末頁</a>
				<?php } ?>
			</div>
		</section>
	</main>
	
  <script src="https://kit.fontawesome.com/e66939fe7a.js" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>
</html>