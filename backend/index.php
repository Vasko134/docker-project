<?php
// index.php

$host = 'db';
$dbname = 'mydb';
$user = 'root';
$pass = 'example';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepares
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Query all messages
    $stmt = $pdo->query('SELECT * FROM messages');

    $messages = $stmt->fetchAll();

} catch (PDOException $e) {
    // Show error and stop script
    die("Database connection failed: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Messages</title>
</head>
<body>
    <h1>Messages</h1>

    <?php if (empty($messages)): ?>
        <p>No messages found.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($messages as $msg): ?>
                <li><?= htmlspecialchars($msg['content']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
