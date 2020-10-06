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
  
  // 使用者不等於 "空" 或不等於 admin
	if ($user === NULL || $user['role'] !== 'Admin') {
		header('Location: index.php');
		exit;
	}

	// 分頁功能
	$page = 1;
	if (!empty($_GET['page'])) {
		$page = intval($_GET['page']); // string -> int
	}
	$items_per_page = 10;
	$offset = ($page - 1) * $items_per_page;

	$stmt = $conn->prepare('SELECT U.id AS id, U.nickname AS nickname, U.username AS username, U.role AS role FROM gaga_w11_hw1_users AS U ORDER BY U.id LIMIT ? OFFSET ?');
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
	<title>管理介面</title> 
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<header class="attation__block">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號密碼。</header>
	<main>
		<section>
			<div class="login__block">
				<h1>管理介面</h1>
				<div class="gohome"><a href="index.php">回首頁</a></div>
			</div>
		</section>

		<section>
			<div class="user__block">
				<table class="user__list">
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Nickname</th>
						<th>使用者權限</th>
					</tr>
					<?php
						while ($row = $result->fetch_assoc()) {
						// print_r($row);
					?>
					<tr>
						<form method="POST" action="handle_admin.php">
						<td><?php echo escape($row['id']) ?></td>
						<td><?php echo escape($row['username']) ?></td>
						<td><?php echo escape($row['nickname']) ?></td>
						<td>
							<!-- id、role 利用 value 值帶入 -->
							<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
							<?php if ($row['role'] === 'Admin') { ?>
								<select name="role">
							    <option value="Admin" selected>管理員</option>
							    <option value="Normal">一般會員</option>
							    <option value="Banned">停權會員</option>
								</select>
							<?php	} ?>
							<?php if ($row['role'] === 'Normal') { ?>
								<select name="role">
							    <option value="Admin">管理員</option>
							    <option value="Normal" selected>一般會員</option>
							    <option value="Banned">停權會員</option>
								</select>
							<?php	} ?>
							<?php if ($row['role'] === 'Banned') { ?>
								<select name="role">
							    <option value="Admin">管理員</option>
							    <option value="Normal">一般會員</option>
							    <option value="Banned" selected>停權會員</option>
								</select>
							<?php	} ?>
								<input class="btn" type="submit" name="submit" value="確認更改">
							</form>
						</td>
					</tr>
					<?php
						}
					?>
				</table>
			</div>
			
			
			
			<div class="hr"></div>
		</section>
		<section class="page__block">
			<?php 
				$stmt = $conn->prepare('SELECT COUNT(id) AS count FROM gaga_w11_hw1_users');
				$result = $stmt->execute();
				$result = $stmt->get_result();
				$row = $result->fetch_assoc();
				$count = $row['count'];
				$total_page = intval(ceil($count / $items_per_page)); // 無條件進位
				// echo gettype($total_page);
			?>
			<div>
				<span>總共有 <?php echo $count ?> 筆會員資料，</span>
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