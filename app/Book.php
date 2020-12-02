<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static get()
 */
class Book extends Model
{
    protected $fillable=['name','desc','price','img','author_id','category_id','pdf','number_download'];
    //books belongsto authors
    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    //book belongsto category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
