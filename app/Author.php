<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable=['name','bio','img'];
    //authors hasmany books
    protected function book()
    {
        return $this->hasMany('App\Book');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($author) {
            // here you could instantiate each related book
            // in this way the boot function in the book model will be called
            $author->book->each(function($book) {
                // and then the static::deleting method when you delete each one
                unlink(public_path("images/books/$book->img"));
                $book->delete();
            });
        });
    }

}
