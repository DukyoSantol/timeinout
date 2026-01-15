<?php

require __DIR__.'/vendor/autoload.php';

echo "=== Timezone Test ===\n";
echo "PHP Default Timezone: " . date_default_timezone_get() . "\n";
echo "Current Server Time: " . date('Y-m-d H:i:s') . "\n";

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Laravel now(): " . \Illuminate\Support\Facades\Date::now()->format('Y-m-d H:i:s') . "\n";
echo "Laravel Asia/Manila: " . \Illuminate\Support\Facades\Date::now('Asia/Manila')->format('Y-m-d H:i:s') . "\n";
echo "Laravel with setTimezone: " . \Illuminate\Support\Facades\Date::now()->setTimezone('Asia/Manila')->format('Y-m-d H:i:s') . "\n";

echo "\n=== Testing Time Record Creation ===\n";
$testTime = \Illuminate\Support\Facades\Date::now()->setTimezone('Asia/Manila');
echo "Test time for record: " . $testTime->format('Y-m-d H:i:s') . "\n";
