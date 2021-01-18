<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private $categories = [
        'Fantasy',
        'Sci-Fi',
        'Román',
        'Triler'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
            ]);
        }
    }
}
