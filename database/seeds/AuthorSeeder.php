<?php

use Illuminate\Database\Seeder;
use App\Author;
class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Taha Hussien', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'img'=>'Author-5fac63619dfc5.jpg',
        ]);
        Author::create([
        'name' => 'Nagib Mahfouz', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'img'=>'Author-5fac635201241.jpg',
            ]);
        Author::create([
            'name' => 'Khaled Tawfeq', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'img'=>'Author-5fac6343d1457.jpg',
        ]);
        Author::create([
            'name' => 'Muhamed Taha', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'img'=>'Author-5fac63381a0c2.jpg',
        ]);
        Author::create([
            'name' => 'Amr Abd El-Hamed', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'img'=>'Author-5fac632213c4a.jpg',
        ]);
        Author::create([
            'name' => 'Ahlam Mosteghanemi', 'bio' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'img'=>'Author-5fac74e14ed59.jpg',
        ]);
    }
}
