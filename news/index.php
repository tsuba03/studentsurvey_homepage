<?php
$dir = __DIR__ . '/posts/';
$files = glob($dir . '*.md');
rsort($files); // 新しい順

echo "<h1>お知らせ一覧</h1><ul>";
foreach ($files as $file) {
    $content = file_get_contents($file);

    // メタ情報抽出
    preg_match('/title:\s*(.+)/', $content, $m1);
    preg_match('/date:\s*(.+)/', $content, $m2);

    $title = $m1[1] ?? basename($file);
    $date  = $m2[1] ?? '';

    $id = urlencode(basename($file));
    echo "<li><a href='view.php?id=$id'>$title</a> ($date)</li>";
}
echo "</ul>";
?>
