<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    private $authors = [
        'Joseph Heller',
        'Jozef Karika',
        'Mario Puzo',
        'J.R.R. Tolkien'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->authors as $author) {
            DB::table('authors')->insert([
                'name' => $author
            ]);
        }
    }
}
