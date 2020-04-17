<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    /**
     * вывод всех новостей
     *
     * 
     */

    public function index()
    {
        return view('admin.index');
    }

    /**
     * вывод оной ноности
     *
     * 
     */

    public function getContentById($name, $id)
    {

        $contentId = explode("-", $id);
        $contentId = $contentId[count($contentId) - 1];

        $category = CategoryNews::query()->get();

        $categoryId = CategoryNews::query()
            ->where('category_alias', $name)
            ->first();

        $news = News::query()->find($contentId);

        if ($news) {

            return view('admin.detail', [
                'categories' => $category,
                'this_category' => $categoryId,
                'news' => $news
            ]);
        } else {

            return view('news.forbidden')->with('categories', $category);
        }
    }
    /**
     * Вывод по категориям
     *
     * 
     */
    public function getContentByCategory($name)
    {

        $category = CategoryNews::query()->get();

        $categoryId = CategoryNews::query()
            ->where('category_alias', $name)
            ->first();

        $news = News::query()
            ->where(
                [
                    'isPrivate' => false,
                    'category_alias' => $name
                ]
            )
            ->leftJoin('category_news', 'news.category_id', '=', 'category_news.id')
            ->orderBy('news.id', 'DESC')
            ->paginate(3);


        if (count($news) !== 0) {

            return view('news.category', [
                'categories' => $category,
                'news' => $news,
                'this_category' => $categoryId
            ]);
        } else {

            return view('news.forbidden')->with('categories', $category);
        }
    }
}
