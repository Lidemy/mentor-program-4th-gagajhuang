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

  $result = $conn->query('SELECT * FROM gaga_w11_hw2_comments WHERE is_deleted IS NULL ORDER BY id DESC LIMIT 5');
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
          <?php if (!$username) { ?>
            <li><a href="login.php">登入</a></li>
          <?php } else{ 
            if ($user['role'] === 'Admin');
          ?>
            <li><a href="admin.php">管理後台</a></li>
            <li><a href="logout.php">登出</a></li>
          <?php } ?>
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
    <div class="posts">
      <?php
        while ($row = $result->fetch_assoc()) {
      ?>
      <article class="post">
        <div class="post__header">
          <div><?php echo escape($row['title']) ?></div>
          <?php if(hasPermission($user, 'update', $row)) { ?>
            <div class="post__actions">
              <a class="post__action" href="edit.php?id=<?php echo $row['id']?>">編輯</a>
            </div>
          <?php } ?>
        </div>
        <div class="post__info"><?php echo escape($row['created_at']) ?></div>
        <div class="post__content"><?php echo escape($row['content']) ?></div>
        <a class="btn-read-more" href="blog.php?id=<?php echo $row['id']?>">READ MORE</a>
      </article>
      <?php } ?>
    </div>
  </div>
  <footer>Copyright © 2020 Gaga's Blog All Rights Reserved.</footer>
</body>
</html>