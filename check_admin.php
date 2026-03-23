<?php

require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'admin@example.com')->first();
if (! $user) {
    echo "ADMIN_NOT_FOUND\n";
    exit(1);
}

print_r($user->toArray());
