<?php

$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$password = '';
$database = 'time_in_out';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Dropping existing tables...\n";
    $conn->exec("DROP TABLE IF EXISTS `time_records`");
    $conn->exec("DROP TABLE IF EXISTS `users`");
    
    echo "Creating users table...\n";
    
    $sql = "CREATE TABLE `users` (
        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `email_verified_at` timestamp NULL DEFAULT NULL,
        `password` varchar(255) NOT NULL,
        `position` varchar(255) DEFAULT NULL,
        `division` varchar(255) DEFAULT NULL,
        `is_admin` tinyint(1) NOT NULL DEFAULT 0,
        `remember_token` varchar(100) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `users_email_unique` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $conn->exec($sql);
    
    echo "Creating time_records table...\n";
    
    $sql = "CREATE TABLE `time_records` (
        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `user_id` bigint unsigned NULL,
        `full_name` varchar(255) NOT NULL,
        `position` varchar(255) NOT NULL,
        `division` varchar(255) NOT NULL,
        `time_in` datetime NOT NULL,
        `time_out` datetime NULL DEFAULT NULL,
        `notes` text NULL,
        `total_hours` decimal(8,2) NULL DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        KEY `time_records_user_id_foreign` (`user_id`),
        CONSTRAINT `time_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $conn->exec($sql);
    
    echo "Creating admin user...\n";
    
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (name, email, password, position, division, is_admin, created_at, updated_at) VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['Admin User', 'admin@timeinout.com', $password, 'Administrator', 'IT']);
    
    echo "Tables created successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
