@extends('template.main')
@section('title')

@if (strpos(url()->current(), 'manager')) {{-- это пока, потом уже будет условие для авторизации --}}

Админ-панель | Новости

@else

@parent Главные

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
    <div class="card-body">
      <div class='w-100'>
        <a href="@if (strpos(url()->current(), 'manager')){{ route('news.category-admin', $categories[$item->category_id]) }}@else{{ route('news.category', $categories[$item->category_id]->category_alias) }}@endif"
          class="badge badge-success mb-3" style="width: 50px;">
          {{ $categories[$item->category_id]->category }}
        </a>
      </div>
      <div class="d-flex justify-content-center align-items-center my-3" style='max-height: 200px; overflow: hidden;'>
        <img class='' src='{{ $item->image ?? asset('storage/images/default.jpg') }}' alt='{{ $item->title }}'
          style='object-fit: cover;'>
      </div>
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

      <a href="{{ route('news.one', [$item->category_alias, $item]) }}" class="btn btn-primary">Подробнее...</a>

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