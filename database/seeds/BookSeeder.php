<?php

use Illuminate\Database\Seeder;
use App\Book;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'name' => 'The Days', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 180, 'img'=>'Book-5fac66584b52c.jpeg', 'author_id'=>1,'category_id'=>6,
            'pdf'=>'Book-5fb566da86515.pdf'
        ]);
        Book::create([
            'name' => 'Between Two palaces', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 30, 'img'=>'Book-5fac6f3f8bec5.png','author_id'=>2,'category_id'=>2,
            'pdf'=>'Book5fb6054685dce.pdf'
        ]);
        Book::create([
            'name' => 'What Beyond Nature', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 45.5, 'img'=>'Book-5fac6f6631bca.jpg', 'author_id'=>3,'category_id'=>7,
            'pdf'=>'Book-5fb57b533cac4.pdf'
        ]);
        Book::create([
            'name' => 'Zicula land', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 60, 'img'=>'Book-5fac6f8a6e7dc.jpg', 'author_id'=>5,'category_id'=>7,
            'pdf'=>'Book5fb58470bdb4e.pdf'
        ]);
        Book::create([
            'name' => 'Not flavored with flamenco', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 35.5, 'img'=>'Book-5fac701765a47.jpg', 'author_id'=>4,'category_id'=>1,
            'pdf'=>'Book5fb60256878c7.pdf'
        ]);
        Book::create([
            'name' => 'Thief and the Dogs', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 25.5, 'img'=>'Book-5fac7352d56d7.jpg', 'author_id'=>2,'category_id'=>6,
            'pdf'=>'Book-5fb554fab1ce7.pdf'
        ]);
        Book::create([
            'name' => 'Utopia', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac73b20d515.jpg', 'author_id'=>3,'category_id'=>7,
            'pdf'=>'Book-5fb60d887f0ab.pdf'
        ]);
        Book::create([
            'name' => "You're not alone", 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac746bc7f64.png', 'author_id'=>3,'category_id'=>4,
            'pdf'=>'Book-5fb57dc165fe9.pdf'
        ]);
        Book::create([
            'name' => "Black befitting you", 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac7540b7fa0.jpg', 'author_id'=>6,'category_id'=>2,
            'pdf'=>'Book5fb6047139637.pdf'
        ]);
        Book::create([
            'name' => "What Beyond The River", 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac764e7f634.jpg', 'author_id'=>1,'category_id'=>4 ,
            'pdf'=>'Book5fb604e81b1fb.pdf'
        ]);
        Book::create([
            'name' => "Exit text", 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac7c03a91a3.jpg', 'author_id'=>4,'category_id'=>1,
            'pdf'=>'Book5fb582db715f4.pdf'
        ]);
        Book::create([
            'name' => "In the rat lane", 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'price' => 50, 'img'=>'Book-5fac7cd983068.jpg', 'author_id'=>3,'category_id'=>2,
            'pdf'=>'Book5fb603f07c930.pdf'
        ]);
    }
}
