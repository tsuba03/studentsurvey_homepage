## ページ構成
```
index.php　... トップページ
favicon.ico　... タブのアイコン
README.md
|-news
    |-index.php ... ニュースページトップ
    |-view.php ... それぞれの記事
    |-Parsedown.php　... Markdownから読み込み
    |-posts ... 記事の格納
    |-_img
    |-parsedown
|-suggestion
|-assets
|-(admin)
```
Parsedown　... https://github.com/erusev/parsedown.git

大学のサーバが正式に対応しているのがPHPなので、バックエンドはPHPによる処理。

---
デザイン　... https://design-system.isct.ac.jp/ja/website

科学大公式のデザインシステムは、完成度が非常に高い。使いたいパーツを切り貼りすればそれでOK。仮にデザインの更新が行われる場合は、assetsを変更する必要がある。

---
データベース

SQLiteを利用。元データはSpreadSheetで管理（なぜならみんなで編集しやすいから）。エディタなどでデータを追加する必要がある。
<br>例：https://sqlitebrowser.org/

今後やりたいこと
- 各提言に概要を追加
    - 何なら全文データベースに格納して簡単に表示できるようにしたい
- 調査資料集をデータベース化
    - 経年変化を追いやすくしたい
    - Excelファイルとして出力を簡単にするなど

---
フロントエンド

自立支援HPに足並みをそろえて、vue.jsで管理（2025/10時点で未実装）

---
やりたい機能追加
- ニュースにタグを追加。検索機能をつける
- ニュースについては、遠隔でポストできるようにしたい