<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['name','desc','price','img','author_id','category_id','pdf','number_download'];
    //books belongsto authors
    protected function author()
    {
        return $this->belongsTo('App\Author');
    }

    //book belongsto category
    protected function category()
    {
        return $this->belongsTo('App\Category');
    }
}
