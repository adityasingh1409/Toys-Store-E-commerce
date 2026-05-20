<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$images = [
    1 => 'https://images.unsplash.com/photo-1608889175123-8ee362201f81?w=600&h=600&fit=crop',
    2 => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?w=600&h=600&fit=crop',
    3 => 'https://images.unsplash.com/photo-1610890716171-6b1bb98ffaed?w=600&h=600&fit=crop',
    4 => 'https://images.unsplash.com/photo-1586165368502-1bad197a6461?w=600&h=600&fit=crop',
    5 => 'https://images.unsplash.com/photo-1520114002627-f0b3b44b2f4f?w=600&h=600&fit=crop',
    6 => 'https://images.unsplash.com/photo-1542614471-1a3b8da70557?w=600&h=600&fit=crop',
    7 => 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=600&h=600&fit=crop',
    8 => 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?w=600&h=600&fit=crop',
    9 => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=600&h=600&fit=crop',
    10 => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=600&h=600&fit=crop',
];

foreach ($images as $id => $url) {
    DB::table('products')->where('id', $id)->update(['image' => $url]);
}

echo "Images updated successfully.\n";
