<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class ParserController extends Controller
{
    static $url = 'http://www.kommersant.ru/RSS/news.xml';

    public function index()
    {

        $news = new News();
        $newsParse = self::news();

        $errors = [];

        foreach ($newsParse as $key => $value) {

            $result = $news::firstOrCreate(
                [
                    'title' => $value['title'],
                    'title_alias' => $value['title_alias'],
                    'category_id' => $value['category_id'],
                    'text' => $value['text'],
                    'url' => $value['link']
                ]
            );

            if (!$result) {
                $errors[] = $value['link'];
            }
        }

        if (count($errors) !== 0) {
            return redirect()
                ->route('news.index')
                ->with([
                    'error' => 'Ошибка добаления новостей!',
                    'errorParseNewsAdd' => $errors
                ]);
        }

        return redirect()
            ->route('news.index')
            ->with(['success' => 'Новости спарсены и успешно добавлены в базу данных!']);
    }

    public static function news()
    {
        $categories = self::category();

        $newsXml = XmlParser::load(self::$url)->parse([
            'news' => ['uses' => 'channel.item[title,description,link,pubDate,category]']
        ]);

        $news = [];

        foreach ($newsXml['news'] as $key => $value) {


            $contains = array_search($value['category'], $categories);

            $not_original = in_array($value['link'], $news);

            if (!$not_original) {

                $news[] = [
                    'title' => $value['title'],
                    'title_alias' => Str::slug($value['title'], '-'),
                    'category_id' => $contains,
                    'text' => $value['description'],
                    'link' => $value['link'],
                    'public' => $value['pubDate']
                ];
            }
        }

        return $news;
    }


    public static function category()
    {
        $categoriesXml = XmlParser::load(self::$url)->parse([
            'categories' => ['uses' => 'channel.item[category]']
        ]);


        $categories = [];
        $count = 1;

        foreach ($categoriesXml['categories'] as $key => $value) {


            $contains = in_array($value['category'], $categories);

            if (!$contains) {

                $categories[$count] = $value['category'];

                $count++;
            }

        }

        return $categories;
    }

}
