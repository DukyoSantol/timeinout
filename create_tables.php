<?php

$host = '127.0.0.1';
$port = '3306';
$user = 'root';
$password = '';
$database = 'time_in_out';

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Creating time_records table...\n";
    
    $sql = "CREATE TABLE IF NOT EXISTS `time_records` (
        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
        `full_name` varchar(255) NOT NULL,
        `position` varchar(255) NOT NULL,
        `division` varchar(255) NOT NULL,
        `time_in` datetime NOT NULL,
        `time_out` datetime DEFAULT NULL,
        `notes` text DEFAULT NULL,
        `total_hours` decimal(8,2) DEFAULT NULL,
        `created_at` timestamp NULL DEFAULT NULL,
        `updated_at` timestamp NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $conn->exec($sql);
    echo "time_records table created successfully\n";
    
    // Create migrations table
    echo "Creating migrations table...\n";
    
    $sql = "CREATE TABLE IF NOT EXISTS `migrations` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `migration` varchar(255) NOT NULL,
        `batch` int NOT NULL,
        PRIMARY KEY (`id`),
        KEY `index_migrations_migration_batch` (`migration`, `batch`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $conn->exec($sql);
    echo "migrations table created successfully\n";
    
    // Mark the migration as run
    $sql = "INSERT INTO `migrations` (`migration`, `batch`) VALUES ('2024_01_01_000001_create_time_records_table', 1)";
    $conn->exec($sql);
    echo "Migration marked as completed\n";
    
    echo "All tables created successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
