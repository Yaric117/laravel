<?php

namespace App\Http\Controllers\Admin;

use App\News;
use App\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        $news = News::paginate(3);

        return view('news.index', [
            'categories' => $category,
            'news' => $news
        ]);
    }

    public function category(CategoryNews $category)
    {

        $categories = CategoryNews::query()
            ->get()
            ->keyBy('id');

        if ($category) {

            $news = $category->news()->paginate(3);

            return view('news.category', [
                'categories' => $categories,
                'category' => $category,
                'news' => $news
            ]);
        } else {

            return view('news.forbidden')->with('categories', $category);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = CategoryNews::query()->get();

        return view('admin.create')->with('categories', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $news = new News();

        if ($request->isMethod('post')) {

            $request->flash();

            $url = null;

            if ($request->file('image')) {

                $path = Storage::putFile('public/images', $request->file('image'));
                $url = Storage::url($path);
            }

            $this->validate($request, News::insertRules(), [], News::attributesForRules());

            $result = $news->fill([
                'title' => $request->title,
                'title_alias' => Str::slug($request->title_alias, '-'),
                'text' => $request->text,
                'category_id' => $request->category_id,
                'isPrivate' => isset($request->isPrivate),
                'image' =>  $url
            ])->save();

            if ($result) {
                return redirect()
                    ->route('news.show', $news)
                    ->with('sucsess', 'Новость  id: ' . $news->id . ' успешно создана!');
            } else {
                return redirect()
                    ->route('news.create')
                    ->with('error', 'Ошибка добавления новости!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        if ($news) {

            return view('admin.detail', [
                'categories' => $category,
                'news' => $news
            ]);
        } else {
            return view('news.forbidden')->with('categories', $category);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        return view('admin.create', [
            'categories' => $category,
            'news' => $news

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->flash();

        $url = null;

        if ($request->file('image')) {

            $path = Storage::putFile('public/images', $request->file('image'));
            $url = Storage::url($path);
        }

        $this->validate($request, News::insertRules($id), [], News::attributesForRules());

        $result = News::where('id', $id)
            ->update([
                'title' => $request->title,
                'title_alias' => Str::slug($request->title_alias, '-'),
                'text' => $request->text,
                'category_id' => $request->category_id,
                'isPrivate' => isset($request->isPrivate),
                'image' =>  $url
            ]);

        if ($result) {
            return redirect()
                ->route('news.show', $id)
                ->with('sucsess', 'Новость  id: ' . $id . ' успешно отредактированна!');
        } else {
            return redirect()
                ->route('news.update', $id)
                ->with('error', 'Ошибка редактирования новости id: ' . $id . '!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        if ($news->delete()) {

            return view('admin.destroy-message')->with('categories', $category);
        }
    }

    public function basket(News $news)
    {

        $category = CategoryNews::query()
            ->get()
            ->keyBy('id');

        return view('admin.basket-news', [
            'categories' => $category,
            'news' => $news::onlyTrashed()->get()
        ]);
    }

    public function deleteFromBasket(Request $request, News $news)
    {
        if ($request->isMethod('post')) {
            $deletedNews = $news::withTrashed()->find($request->deleteBasket);
            $result = $deletedNews->forceDelete();

            if ($result) {
                return redirect()
                    ->route('news.basket')
                    ->with('sucsess', 'Новость  id: ' . $deletedNews->id . ' удалена из корзины!');
            } else {
                return redirect()
                    ->route('news.basket')
                    ->with('error', 'Ошибка удаления новости  id: ' . $deletedNews->id . '!');
            }
        }
    }

    public function restoreFromBasket(Request $request, News $news)
    {
        if ($request->isMethod('post')) {
            $restoreNews = $news::withTrashed()->find($request->restoreBasket);
            $result = $restoreNews->restore();

            if ($result) {
                return redirect()
                    ->route('news.basket')
                    ->with('sucsess', 'Новость  id: ' . $restoreNews->id . ' успешно восстановлена!');
            } else {
                return redirect()
                    ->route('news.basket')
                    ->with('error', 'Ошибка восстановления новости id: ' . $restoreNews->id . ' из корзины!');
            }
        }
    }
}
