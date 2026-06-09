<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    echo json_encode(['ok' => false, 'error' => 'not_logged_in']);
    exit;
}

$data   = json_decode(file_get_contents('php://input'), true);
$game   = trim($data['game']   ?? '');
$action = trim($data['action'] ?? '');

if (!$game || !in_array($action, ['like', 'unlike'])) {
    echo json_encode(['ok' => false, 'error' => 'invalid']);
    exit;
}

$username = $_SESSION['username'];
$file     = 'likes.txt';
$lines    = file_exists($file)
    ? file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
    : [];

$entry = $username . '|' . $game;

if ($action === 'like') {
    if (!in_array($entry, $lines)) {
        $lines[] = $entry;
    }
} else {
    $lines = array_values(array_filter($lines, fn($l) => $l !== $entry));
}

file_put_contents($file, implode("\n", $lines) . (count($lines) ? "\n" : ''));
echo json_encode(['ok' => true]);
