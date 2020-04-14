@extends('template.main')

@section('title')

Админ-панель | Корзина новостей

@endsection

@include('admin.menu')
@include('admin.menu_news')


@section('contents')

<div class="row">

    @forelse ($news as $item)
    <div class="card mb-3 w-100">
        <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <h5 class="card-title">id: {{ $item->id }}</h5>

            <form action='{{ route('news.restoreFromBasket', $item) }}' enctype="multipart/form-data" method="Post"
                class='mt-3'>
                @csrf
                <input type="hidden" name='restoreBasket' value="{{ $item->id }}">
                <button type="submit" class="btn btn-success" name='actionRestore'>Востановить</button>
            </form>

            <form action='{{ route('news.deleteFromBasket', $item) }}' enctype="multipart/form-data" method="Post"
                class='mt-3'>
                @csrf
                <input type="hidden" name='deleteBasket' value="{{ $item->id }}">
                <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить из корзины</button>
            </form>
            
        </div>
    </div>
    @empty
    <div class="alert alert-primary" role="alert">
        Корзина пуста!
    </div>
    @endforelse

</div>


@endsection