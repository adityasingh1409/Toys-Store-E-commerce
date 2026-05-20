<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$url = 'https://placehold.co/600x600/0d6efd/ffffff/png?text=Monopoly';
$affected = DB::table('products')->where('name', 'Monopoly')->update(['image' => $url]);

echo "Updated " . $affected . " row(s).\n";
