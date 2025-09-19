<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}
?>

<h1>新規記事作成</h1>
<form action="save.php" method="post">
    タイトル: <input type="text" name="title" required><br>
    ファイル名（形式：YYYYMMDD_title）: <input type="text" name="filename" required>.md<br>
    本文 (Markdown):<br>
    <textarea name="body" rows="20" cols="80" required></textarea><br>
    画像アップロード: <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="保存">
</form>
