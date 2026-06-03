<?php
session_start();

$username = $_SESSION["username"] ?? "";
$game = $_POST["game"] ?? "";
$comment = $_POST["comment"] ?? "";

if ($username === "") {
    header("Location: profile.php?error=login_required");
    exit;
}

if ($game === "" || $comment === "") {
    header("Location: all games.php?comment_error=empty");
    exit;
}

$file = "comments.txt";

if (!file_exists($file)) {
    file_put_contents($file, "");
}

$time = date("Y-m-d H:i:s");

$newComment = $username . "|" . $game . "|" . $comment . "|" . $time . "\n";

file_put_contents($file, $newComment, FILE_APPEND);

header("Location: all games.php");
exit;
?>