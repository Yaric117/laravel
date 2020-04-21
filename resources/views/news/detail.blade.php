@extends('template.main')

@section('title')

@parent {{ $news->title }}

@endsection

@include('menu')


@section('contents')

<div class="row">
  <div class="card w-100">
    <div class="card-body">
      <a href="{{ route('news.category', $category->category_alias) }}" class="badge badge-success mb-3"
        style="width: 50px;">
        {{ $category->category }}
      </a>
      <div class="d-flex justify-content-center align-items-center my-3" style='max-height: 200px; overflow: hidden;'>
        <img class='' src='{{ $news->image ?? asset('storage/images/default.jpg') }}' alt='{{ $news->title }}'
          style='object-fit: cover;'>
      </div>
      <h5 class="card-title">{{ $news->title }}</h5>
      <p class="card-text">{{ $news->text }}</p>
        @if($news->url)
            <a href="{{ $news->url }}" class="btn btn-primary" target="_blank">Читать в источнике...</a>
        @endif
      <a href="{{ route('news.all') }}" class="btn btn-primary">Все новости...</a>
    </div>
  </div>
</div>

@endsection
