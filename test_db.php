<?php

$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$password = '';
$database = 'time_in_out';

try {
    // Test connection without database first
    $conn = new PDO("mysql:host=$host;port=$port", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to MySQL server\n";
    
    // Create database if it doesn't exist
    $conn->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$database' created or already exists\n";
    
    // Test connection with database
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully to database '$database'\n";
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
