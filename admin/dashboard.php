<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<h1>管理者ダッシュボード</h1>
<ul>
    <li><a href="new.php">新規記事作成</a></li>
    <li><a href="list.php">記事一覧・編集</a></li>
    <li><a href="logout.php">ログアウト</a></li>
</ul>
