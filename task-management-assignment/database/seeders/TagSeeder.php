<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $tags = ['Work', 'Personal', 'Urgent', 'Low Priority', 'Home'];
    
    foreach ($tags as $tag) {
        \App\Models\Tag::create(['name' => $tag]);
    }
}
}
