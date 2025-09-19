<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$title    = $_POST['title'];
$filename = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['filename']); // 安全化
$body     = $_POST['body'];

// 画像アップロード
$uploadDir = __DIR__ . '/../news/_img/';

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];
    $filename = preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    
    // ディレクトリがなければ作成
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $target = $uploadDir . $filename;
    if (move_uploaded_file($file['tmp_name'], $target)) {
        // 本文に自動でMarkdown画像タグを追加
        $body .= "\n\n![$filename](_img/$filename)\n";
    } else {
        $errorMsg = "画像の保存に失敗しました";
    }
}

// 保存先ディレクトリ
$dir = __DIR__ . '/../news/posts/';

// Markdownファイル作成（Front Matter）
$content = "---\n";
$content .= "title: $title\n";
$content .= "date: ".date('Y-m-d')."\n";
$content .= "---\n\n";
$content .= $body;

// 保存
// file_put_contents($dir . $filename . '.md', $content);
$filepath = $dir . $filename . '.md';
if(file_put_contents($filepath, $content) === false){
    die("ファイルの保存に失敗しました: $filepath");
}else{
    echo "保存成功: $filepath";
}

// リダイレクト
header("Location: list.php");
exit;
