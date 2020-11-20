<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Psychology'
        ]);Category::create([
            'name'=>'Novels'
        ]);Category::create([
            'name'=>'Children'
        ]);Category::create([
            'name'=>'Philosophy'
        ]);Category::create([
            'name'=>'Poetry'
        ]);Category::create([
            'name'=>'literature'
        ]);Category::create([
            'name'=>'Fiction'
        ]);
    }
}
