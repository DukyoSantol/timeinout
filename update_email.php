<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::find(1);
if ($user) {
    $user->email = 'admin@MGB.com';
    $user->save();
    echo "Updated admin email to: " . $user->email . "\n";
} else {
    echo "Admin user (ID 1) not found\n";
}
