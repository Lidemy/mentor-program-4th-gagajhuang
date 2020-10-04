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
  if (!$username || $user['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
  }

  $id = $_GET['id'];
  $stmt = $conn->prepare('SELECT * FROM gaga_w11_hw2_comments WHERE id =?');
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();

  if(!$result){
    die('Error' . $conn->error);
  };
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();// 取出內容
  // print_r($row);

?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <nav class="navbar">
    <div class="wrapper navbar__wrapper">
      <div class="navbar__site-name">
        <a href='index.php'>Gaga's Blog</a>
      </div>
      <ul class="navbar__list">
        <div>
          <li><a href="list.php">文章列表</a></li>
          <li><a href="#">分類專區</a></li>
          <li><a href="#">關於我</a></li>
        </div>
        <div>
          <li><a href="admin.php">管理後台</a></li>
          <li><a href="logout.php">登出</a></li>
        </div>
      </ul>
    </div>
  </nav>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <?php 
          if (!empty($_GET['errCode'])) {
            $msg ='Error';
            if ($_GET['errCode'] === '1') {
              $msg = '資料不齊全！';
            }
            echo '<h3>'. $msg .'</h3>';
          }
        ?>
        <form action="handle_update_comment.php" method="POST">
          <div class="edit-post__title">
            發表文章：
          </div>
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
          <div class="edit-post__input-wrapper">
            <input class="edit-post__input" placeholder="<?php echo $row['title']?>" />
          </div>
          <div class="edit-post__input-wrapper">
            <textarea rows="20" class="edit-post__content" name="content"><?php echo $row['content']?></textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <button class="edit-post__btn" type="submit">送出</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Gaga's Blog All Rights Reserved.</footer>
</body>
</html>