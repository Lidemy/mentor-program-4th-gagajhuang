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

  if ($user['role'] !== 'Admin') {
    header('Location: login.php');
    exit;
  }
  // 記得加入 WHERE is_deleted IS NULL 才能隱藏留言
  $result = $conn->query('SELECT * FROM gaga_w11_hw2_comments WHERE is_deleted IS NULL ORDER BY id DESC');
  if(!$result){
    die('Error' . $conn->error);
  };

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
          <li><a href="add.php">新增文章</a></li>
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
      <div class="admin-posts">
        <?php
          while ($row = $result->fetch_assoc()) {
        ?>
        <div class="admin-post">
          <div class="admin-post__title"><?php echo escape($row['title']) ?></div>
          <div class="admin-post__info">
            <div class="admin-post__created-at"><?php echo escape($row['created_at']) ?></div>
            <?php if(hasPermission($user, 'update', $row)) { ?>
            <a class="admin-post__btn" href="edit.php?id=<?php echo $row['id']?>">
              編輯
            </a>
            <a class="admin-post__btn" href="handle_delete_comment.php?id=<?php echo $row['id']?>">
              刪除
            </a>
            <?php
              }
            ?>
          </div>
        </div>
        <?php 
          } 
        ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Gaga's Blog All Rights Reserved.</footer>
</body>
</html>