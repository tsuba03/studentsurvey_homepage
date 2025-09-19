<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // 簡易チェック（本番はハッシュ化やDBにする）
    if ($user === 'admin' && $pass === 'password') {
        $_SESSION['logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "ユーザー名かパスワードが違います";
    }
}
?>

<h1>管理者ログイン</h1>
<?php if(!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="post">
    ユーザー名: <input type="text" name="username" required><br>
    パスワード: <input type="password" name="password" required><br>
    <input type="submit" value="ログイン">
</form>
