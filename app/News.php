<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class News extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'title', 'text', 'category_id', 'isPrivate', 'image', 'url', 'title_alias', 'created_at', 'updated_at', 'deleted_at'
    ];

    public static  function insertRules($id = '')
    {
        $newsTable = (new News())->getTable();
        $categoryTable = (new CategoryNews())->getTable();

        return [

            'title' => [
                'required',
                'min:2',
                'max:100'
            ],

            'title_alias' => [
                'required',
                'min:2',
                'max:100',
                "unique:{$newsTable},title_alias,{$id}"
            ],

            'category_id' => [
                'required',
                'integer',
                "exists:{$categoryTable},id"
            ],

            'text' => [
                'required',
                'min:10'
            ],

            'image' => [
                'file',
                'mimetypes:image/png,image/jpeg',
                'max:1000'
            ],

            'isPrivate' => [
                'boolean'
            ]
        ];
    }

    public static  function attributesForRules()
    {
        return [

            'title' => 'Заголовок новости',
            'category_id' => 'Категория',
            'text' => 'Текст новости',
            'isPrivate' => 'Приватность',
            'image' => 'Изображение новости',
            'title_alias' => 'URL'

        ];
    }
}
