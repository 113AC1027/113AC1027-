<?php
function showGameComments($currentGame) {
    $commentFile = "comments.txt";
    $hasComment = false;

    if (file_exists($commentFile)) {
        $lines = file($commentFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode("|", $line);

            $savedUsername = $parts[0] ?? "";
            $savedGame = $parts[1] ?? "";
            $savedComment = $parts[2] ?? "";
            $savedTime = $parts[3] ?? "";

            if ($savedGame === $currentGame) {
                $hasComment = true;

                echo '<div class="comment-item">';
                echo '<p class="comment-user">' . htmlspecialchars($savedUsername) . '</p>';
                echo '<p class="comment-text">' . htmlspecialchars($savedComment) . '</p>';
                echo '<p class="comment-time">' . htmlspecialchars($savedTime) . '</p>';
                echo '</div>';
            }
        }
    }

    if (!$hasComment) {
        echo '<p class="comment-empty">No comments yet.</p>';
    }
}
?>