<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{

    protected $fillable = [
        'category', 'category_alias',
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

}
