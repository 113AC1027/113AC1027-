<?php
session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$file = "users.txt";

if ($username === "tuna" && $password === "1234") {
    $_SESSION["username"] = $username;
    header("Location: profile.php");
    exit;
}

/* 如果txt在 就執行 */
if (file_exists($file)) {
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);       //內容抓成陣列

    foreach ($lines as $line) {         //陣列在每一個每一組抓出來看
        $parts = explode("|", $line);   //帳密分開看 成 陣列0 陣列1

        $savedUsername = $parts[0] ?? "";
        $savedPassword = $parts[1] ?? "";

        if ($username === $savedUsername && $password === $savedPassword) {
            $_SESSION["username"] = $username;
            header("Location: profile.php");
            exit;
        }
    }
}

/* 如果前面都沒有登入成功，就代表帳密錯誤 */
header("Location: profile.php?error=1");
exit;
?>