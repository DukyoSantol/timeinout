<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Checking all users in database ===\n\n";
$users = App\Models\User::all();
foreach ($users as $user) {
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Password field empty: " . (empty($user->password) ? "YES" : "NO") . "\n";
    echo "Admin: " . ($user->is_admin ? "YES" : "NO") . "\n";
    echo "---\n";
}

echo "\n=== Testing password verification ===\n\n";
$admin = App\Models\User::where('email', 'admin@MGB.com')->first();
if ($admin) {
    $hasher = app('hash');
    $matches = $hasher->check('password123', $admin->password);
    echo "Admin user found!\n";
    echo "Password hash: " . substr($admin->password, 0, 20) . "...\n";
    echo "Password 'password123' matches hash: " . ($matches ? "YES" : "NO") . "\n";
} else {
    echo "Admin user NOT found!\n";
}
