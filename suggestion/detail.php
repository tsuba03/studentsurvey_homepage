<?php
$db = new PDO("sqlite:". __DIR__ . "/../assets/db/teigen.db");
$id = $_GET['id'] ?? 0;

$stmt = $db->prepare("SELECT * FROM teigen WHERE ID = :id");
$stmt->execute([':id' => $id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo "ID is $id <br>";

if ($row) {
    echo "<h2>" . htmlspecialchars($row['Title']) . "</h2>";
    echo "発行年: {$row['Year']}<br>";
    echo "大分類: {$row['Category']}<br>";
    echo "種類: {$row['Type']}<br>";
    echo "大分類番号: {$row['CategoryNo']}<br>";
    echo "記事番号: {$row['TeigenNo']}<br>";
    echo "ページ: {$row['Page']}<br>";
    echo "関連記事ページ: {$row['ResponsePage']}<br>";

    // PDFリンク生成
    $year = $row['Year'];
    $page = $row['Page'] + 3;
    if($year>=2022){
        if($year==2022 && $row['CategoryNo']>10){
            $pdf_path = "https://www.siengp.titech.ac.jp/gakuseichousa/2022/gakuseichosa2022_houkokusyo_ver3.pdf";
        }else{
            $pdf_path = "https://www.siengp.titech.ac.jp/gakuseichousa/$year/{$year}_gakusei_teigensho.pdf";
            $response_pdf = "https://www.siengp.titech.ac.jp/gakuseichousa/$year/gakuseichosa{$year}_daigakunotaio.pdf";
        }
    }else{
        $pdf_path = "https://www.siengp.titech.ac.jp/gakuseichousa/$year/{$year}_gakusei_teigensyo.pdf";
        $response_pdf = "https://www.siengp.titech.ac.jp/gakuseichousa/$year/{$year}_gakusei_follow.pdf";
    }

    if($row['ResponsePage']){
        $res_page = $row['ResponsePage'] + 1;
        echo "<a href='$pdf_path#page=$page' target='_blank'>冊子PDFを見る</a><br>";
        echo "<a href='$response_pdf#page=$res_page' target='_blank'>関連記事PDFを見る</a><br>";
        echo "<iframe src= $pdf_path#page=$page width='80%' height='600px'></iframe>";
        echo "<iframe src= $response_pdf#page=$res_page width='80%' height='600px'></iframe>";
    }else{
        echo "<a href='$pdf_path#page=$page' target='_blank'>冊子PDFを見る</a><br>";
        echo "<iframe src= $pdf_path#page=$page width='80%' height='600px'></iframe>";
    }
} else {
    echo "記事が見つかりません";
}
?>
