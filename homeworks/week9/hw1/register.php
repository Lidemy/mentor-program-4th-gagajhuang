
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>註冊會員</title> 
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<header class="attation__block">注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號密碼。</header>
	<main>
		<section>
			<div class="login__block">
				<h1>註冊會員 Register</h1>
				<div class="login__user">
					<p>你好！<span></span></p>
					<button class="btn"><a href="login.php">登入</a></button>
					<button class="btn"><a href="index.php">回留言板</a></button>
				</div>
			</div>
			<form class="board__block" method="POST" action="handle_register.php">
				<div class="input__block">暱稱：<input type="text" name="nickname"></div>
				<div class="input__block">帳號：<input type="text" name="username"></div>
				<div class="input__block">密碼：<input type="password" name="password"></div>
				<input class="btn" type="submit" name="submit" value="送出">
				<?php 
					if (!empty($_GET['errCode'])) {
						$msg ='Error';
						if ($_GET['errCode'] === '1') {
							$msg = '請輸入資料！';
						}else if($_GET['errCode'] === '2'){
							$msg = '帳號已被註冊';
						}
						echo '<span>'. $msg .'</span>';
					}
				 ?>
			</form>
		</section>
	</main>
	
  <script src="https://kit.fontawesome.com/e66939fe7a.js" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</body>
</html>