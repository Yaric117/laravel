<?php

namespace App\Http\Controllers\News;

use App\News;
use App\CategoryNews;
use  App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * вывод всех ноностей
     *
     *
     */

    public function index()
    {

        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        $news = News::query()
            ->where('isPrivate', false)
            ->orderBy('news.id', 'DESC')
            ->paginate(5);

        return view('news.index', [
            'categories' => $category,
            'news' => $news
        ]);
    }

    /**
     * вывод оной ноности
     *
     *
     */

    public function showOne($category, $news)
    {

        $categories = CategoryNews::query()
            ->get()
            ->keyBy('id');

        $category = CategoryNews::where('category_alias', $category)->first();

        $newsOne = News::where('title_alias','=', $news)->first();

        if ($newsOne) {

            return view('news.detail', [
                'categories' => $categories,
                'news' => $newsOne,
                'category' => $category
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
    public function category($name)
    {

        $categories = CategoryNews::query()
            ->get()
            ->keyBy('id');

        $category = CategoryNews::where('category_alias', $name)->first();

        if ($category) {

            $news = CategoryNews::where('category_alias', $name)
                ->first()
                ->news()
                ->where('isPrivate', false)
                ->orderBy('news.id', 'DESC')
                ->paginate(5);

            return view('news.category', [
                'categories' => $categories,
                'news' => $news,
                'category' => $category
            ]);
        } else {

            return view('news.forbidden')->with('categories', $category);
        }
    }
}
