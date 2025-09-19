<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$filename = basename($_GET['file']);
$filepath = __DIR__ . '/../news/posts/' . $filename . '.md';

if (!file_exists($filepath)) {
    die("記事が存在しません");
}

$lines = file($filepath);
preg_match('/^title:\s*(.+)$/', $lines[1], $m);
$title = $m[1] ?? '';
$body = implode("", array_slice($lines, 4)); // Front Matter除く本文

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newBody = $_POST['body'];
    $title = $_POST['title'];

    $content = "---\n";
    $content .= "title: $title\n";
    $content .= "date: ".date('Y-m-d')."\n";
    $content .= "---\n\n";
    $content .= $newBody;

    file_put_contents($filepath, $content);
    header("Location: list.php");
    exit;
}
?>

<h1>記事編集</h1>
<form method="post">
    タイトル: <input type="text" name="title" value="<?= htmlspecialchars($title) ?>"><br>
    本文 (Markdown):<br>
    <textarea name="body" rows="20" cols="80"><?= htmlspecialchars($body) ?></textarea><br>
    <input type="submit" value="保存">
</form>
