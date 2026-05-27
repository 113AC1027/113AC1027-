<?php
session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// 測試帳號
if ($username === "tuna" && $password === "1234") {
    $_SESSION["username"] = $username;
    header("Location: profile.php");
    exit;
} else {
    header("Location: profile.php?error=1");
    exit;
}
?>