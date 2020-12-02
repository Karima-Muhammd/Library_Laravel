<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static get()
 * @method static find(int $id)
 * @method static create(array $array)
 */
class Author extends Model
{

    protected $fillable=['name','bio','img'];
    //authors hasmany books
    public function book()
    {
        return $this->hasMany(Book::class);
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
