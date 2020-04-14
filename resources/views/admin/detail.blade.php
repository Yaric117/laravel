@extends('template.main')

@section('title')

Админ-панель | {{ $news->title }}

@endsection

@include('admin.menu')
@include('admin.menu_news')

@section('contents')

<div class="row">
  <div class="card w-100">
    <div class="card-body">
      <div class="alert alert-light m-0" role="alert">
        категория: {{ $categories[$news->category_id]->category }}
      </div>
      <div class="alert alert-light" role="alert">
        приватная: @if(!empty($news->isPrivate)) да @else нет @endif
      </div>
      <div class="d-flex justify-content-center align-items-center my-3" style='max-height: 200px; overflow: hidden;'>
        <img class='' src='{{ $news->image ?? asset('storage/images/default.jpg') }}' alt='{{ $news->title }}'
          style='object-fit: cover;'>
      </div>
      <h5 class="card-title">{{ $news->title }}</h5>
      <p class="card-text">{{ $news->text }}</p>

      <a href='{{ route('news.edit', $news) }}' class="btn btn-outline-success">Редактировать</a>

      <form action='{{ route('news.destroy', $news) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
        {{ method_field('DELETE') }}
        @csrf
        <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
      </form>

    </div>
  </div>
</div>

@endsection