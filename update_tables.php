<?php

$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$password = '';
$database = 'time_in_out';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating users table...\n";
    
    $sql = "CREATE TABLE IF NOT EXISTS `users` (
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
    
    echo "Updating time_records table...\n";
    
    $sql = "ALTER TABLE `time_records` ADD COLUMN `user_id` bigint unsigned NULL AFTER `id`";
    $conn->exec($sql);
    
    echo "Adding foreign key constraint...\n";
    
    $sql = "ALTER TABLE `time_records` ADD CONSTRAINT `time_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL";
    $conn->exec($sql);
    
    echo "Tables updated successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
