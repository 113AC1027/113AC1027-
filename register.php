<?php
session_start();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";
$passwordConfirm = $_POST["password_confirm"] ?? "";

if ($username === "" || $password === "" || $passwordConfirm === "") {
    header("Location: profile.php?register_error=empty");
    exit;
}

if ($password !== $passwordConfirm) {
    header("Location: profile.php?register_error=password");
    exit;
}

$file = "users.txt";

if (!file_exists($file)) {
    file_put_contents($file, "");
}

$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    $parts = explode("|", $line);
    $savedUsername = $parts[0] ?? "";

    if ($username === $savedUsername) {
        header("Location: profile.php?register_error=exists");
        exit;
    }
}

$newUser = $username . "|" . $password . "\n";
file_put_contents($file, $newUser, FILE_APPEND);

$_SESSION["username"] = $username;

header("Location: profile.php");
exit;
?>