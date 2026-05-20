<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$images = [
    3 => 'https://images.unsplash.com/photo-1611891487122-207578367d98?w=600&h=600&fit=crop', // Monopoly alt
    5 => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=600&h=600&fit=crop', // Landscape alt
    6 => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?w=600&h=600&fit=crop', // Animals alt
];

foreach ($images as $id => $url) {
    DB::table('products')->where('id', $id)->update(['image' => $url]);
}

echo "Fixed broken images successfully.\n";
