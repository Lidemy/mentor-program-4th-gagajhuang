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

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = intval($_GET['page']);
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  // $result = $conn->query('SELECT * FROM gaga_w11_hw2_comments ORDER BY id DESC');
  $stmt = $conn->prepare('SELECT * FROM gaga_w11_hw2_comments WHERE is_deleted IS NULL ORDER BY id DESC LIMIT ? OFFSET ?');
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();

  if(!$result){
    die('Error' . $conn->error);
  };
  $result = $stmt->get_result();

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
            if ($user['role'] === 'Admin')
          ?>
            <li><a href="admin.php">管理後台</a></li>
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
    <div class="page__block">
      <?php 
        $stmt = $conn->prepare('SELECT COUNT(id) AS count FROM gaga_w11_hw2_comments WHERE is_deleted IS NULL');
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $total_page = intval(ceil($count / $items_per_page));
      ?>
      <div>
        <span>總共有 <?php echo $count ?> 筆留言，</span>
        <span>目前頁數：<?php echo $page ?> / <?php echo $total_page ?></span>
      </div>
      <div class="page__list">
        <?php if ($page !== 1) { ?>
          <a href="list.php?page=1">首頁</a>
          <a href="list.php?page=<?php echo $page - 1 ?>">上一頁</a>
        <?php } ?>
        <?php if ($page !== $total_page) { ?>
          <a href="list.php?page=<?php echo $page + 1 ?>">下一頁</a>
          <a href="list.php?page=<?php echo $total_page ?>">最末頁</a>
        <?php } ?>
      </div>
    </div>
  </div>
  
  <footer>Copyright © 2020 Gaga's Blog All Rights Reserved.</footer>
</body>
</html>