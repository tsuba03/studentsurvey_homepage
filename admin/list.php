<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$dir = __DIR__ . '/../news/posts/';
$files = glob($dir . '*.md');
rsort($files);

echo "<h1>記事一覧</h1><ul>";
foreach ($files as $file) {
    $basename = basename($file, '.md');
    $lines = file($file);
    preg_match('/title:\s*(.+)/', $lines[1], $m); // Front Matterからタイトル取得
    $title = $m[1] ?? $basename;
    echo "<li>$title - <a href='edit.php?file=$basename'>編集</a></li>";
}
echo "</ul>";
?>

<a href="dashboard.php">ダッシュボード</a>