@extends('template.main')

@section('title')

@if (strpos(url()->current(), 'manager')) {{-- это пока, потом уже будет условие для авторизации --}}

Админ-панель | Новости | {{ $category->category }}

@else

@parent {{ $category->category }}

@endif


@endsection

@if (strpos(url()->current(), 'manager')) {{-- это пока, потом уже будет условие для авторизации --}}

@include('admin.menu')
@include('admin.menu_news')

@else

@include('menu')
@include('news.menu')

@endif

@section('contents')

<div class="row">

  {{ $news->links() }}

  @forelse ($news as $item)
  <div class="card mb-3">
    <div class="d-flex justify-content-center align-items-center mb-3" style='max-height: 200px; overflow: hidden;'>
      <img class='' src='{{ $item->image ?? asset('storage/images/default.jpg') }}' alt='{{ $item->title }}'
        style='object-fit: cover;'>
    </div>
    <div class="card-body">
      <h5 class="card-title" @if($item->deleted_at) style='color: red;' @endif>@if($item->deleted_at)
        <del>{{ $item->title }}</del> @else {{ $item->title }} @endif </h5>
      <p class="card-text @if($item->deleted_at) d-none @endif">{{ $item->text }}</p>

      @if (strpos(url()->current(), 'manager')) {{-- это пока, потом уже будет условие для авторизации --}}

      @if($item->isPrivate)
      <div class='w-100'>
        <span class="badge badge-warning mb-3" style="width: 100px;">
          приватная!
        </span>
      </div>
      @endif

      @if($item->deleted_at)

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

      @else

      <a href='{{ route('news.edit', $item) }}' class="btn btn-outline-success">Редактировать</a>

      <form action='{{ route('news.destroy', $item) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
        {{ method_field('DELETE') }}
        @csrf
        <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
      </form>

      @endif

      @else

      <a href="{{ route('news.one', [$category->category_alias, $item->title_alias]) }}"
        class="btn btn-primary">Подробнее...</a>

      @endif

    </div>
  </div>
  @empty
  <div class="alert alert-primary" role="alert">
    Пока новостей нет!
  </div>
  @endforelse

  {{ $news->links() }}
</div>
@endsection