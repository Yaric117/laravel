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
      <h5 class="card-title">{{ $item->title }}</h5>
      <p class="card-text">{{ $item->text }}</p>

      @if (strpos(url()->current(), 'manager')) {{-- это пока, потом уже будет условие для авторизации --}}

      <a href='{{ route('news.edit', $item) }}' class="btn btn-outline-success">Редактировать</a>

      <form action='{{ route('news.destroy', $item) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
        {{ method_field('DELETE') }}
        @csrf
        <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
      </form>

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