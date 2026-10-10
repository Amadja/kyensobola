<?php
declare(strict_types=1);

$dbHost = 'localhost';
$dbName = 'kyensobola';
$dbUser = 'YOUR_DB_USER';
$dbPass = 'YOUR_DB_PASSWORD';

try {
    $pdo = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    exit('Database connection failed. Please check config/database.php.');
}
