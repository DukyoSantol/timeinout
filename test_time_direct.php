<?php

// Simple test to check time endpoint
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test the getCurrentTime endpoint directly
$controller = new App\Http\Controllers\TimeRecordController();
$response = $controller->getCurrentTime();

echo "=== TIME ENDPOINT TEST ===\n";
echo "JSON Response:\n";
echo json_encode($response->getData(), JSON_PRETTY_PRINT) . "\n";

echo "\nFormatted time: " . $response->getData()['time'] . "\n";

if (isset($response->getData()['debug'])) {
    echo "\nDebug info:\n";
    foreach ($response->getData()['debug'] as $key => $value) {
        echo "  $key: $value\n";
    }
}

echo "\n=== END TEST ===\n";
