@extends('template.main')

@section('title')

Админ-панель | Удаление новости в корзину

@endsection

@include('admin.menu')
@include('admin.menu_news')


@section('contents')

<div class="alert alert-success" role="alert">
    Новость помещена в корзину!
</div>

<a href='{{ route('news.basket') }}' class="btn btn-primary">Перейти в корзину</a>
<a href='{{ route('news.index') }}' class="btn btn-primary">Перейти к редактированию новостей</a>


@endsection