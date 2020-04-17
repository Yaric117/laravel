@extends('template.main')

@section('title')

Админ-панель | Добавление новости

@endsection

@include('admin.menu')
@include('admin.menu_news')

@section('contents')

@if (!empty($news))

<div class="alert alert-light" role="alert">
  Редактирование новости
</div>

@endif

<form class='' action='@if(!empty($news)){{ route('news.update', $news) }}@else{{ route('news.store') }}@endif'
  enctype="multipart/form-data" method="POST">

  @if(!empty($news)) {{ method_field('PUT') }} @endif

  @csrf
  {{-- Заголовок новости --}}
  <div class="form-group">
    <label for="news_caption">Заголовок новости*:</label>
    <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" id="news_caption" name='title'
      aria-describedby="text" value='{{ old('title') ?? $news->title ?? '' }}'>

    @if ($errors->has('title'))

    <div class="invalid-feedback">

      @foreach($errors->get('title') as $error)

      <p>{{ $error }}</p>

      @endforeach

    </div>

    @else

    <small class='text-muted'>мин. 2 макс. 100 символов </small>

    @endif


  </div>
  {{-- ЧПУ --}}
  <div class="form-group">
    <label for="news_caption">URL*:</label>
    <input type="text" class="form-control @if ($errors->has('title_alias')) is-invalid @endif" id="news_caption"
      name='title_alias' aria-describedby="text" value='{{ old('title_alias') ??  $news->title_alias ?? ''  }}'>

    @if ($errors->has('title_alias'))

    <div class="invalid-feedback">

      @foreach($errors->get('title_alias') as $error)

      <p>{{ $error }}</p>

      @endforeach

    </div>

    @else

    <small class='text-muted'>мин. 2 макс. 100 символов</small>

    @endif


  </div>
  {{-- Категория --}}
  <select class="custom-select my-3 @if ($errors->has('category_id')) is-invalid @endif" name='category_id'>
    <option>Выберете категорию:*</option>

    @forelse ($categories as $item)

    <option @if (!empty($news) && old('category_id')==$item->id || !empty($news) && $news->category_id == $item->id)
      selected @elseif (empty($news) && $item->id == old('category_id')) selected @endif
      value="{{ $item->id }}">{{ $item->category}}</option>

    @empty

    <option disabled>категории не добавлены</option>

    @endforelse

  </select>

  @if ($errors->has('category_id'))

  <div class="invalid-feedback">

    @foreach($errors->get('category_id') as $error)

    <p>{{ $error }}</p>

    @endforeach

  </div>

  @endif
  {{-- Текст новости --}}
  <div class="form-group">
    <label for="news-text">Текст новости:*</label>
    <textarea class="form-control @if ($errors->has('text')) is-invalid @endif" id="news-text" rows="5"
      name='text'>{{ old('text') ??  $news->text ?? ''  }}</textarea>

    @if ($errors->has('text'))

    <div class="invalid-feedback">

      @foreach($errors->get('text') as $error)

      <p>{{ $error }}</p>

      @endforeach

    </div>

    @else

    <small class='text-muted'>мин. 5 символов </small>

    @endif

  </div>
  {{-- Изображение новости --}}
  <div class="form-group">
    <label for="news-img">Изображение новости:</label>
    <input type="file" class="form-control-file @if ($errors->has('image')) is-invalid @endif" id="news-img"
      name='image' accept="image/png, image/jpeg" multiple>

    @if ($errors->has('image'))

    <div class="invalid-feedback">

      @foreach($errors->get('image') as $error)

      <p>{{ $error }}</p>

      @endforeach

    </div>

    @else

    <small class='text-muted'>форматы: image/png, image/jpeg </small>

    @endif

  </div>

  @if(!empty($news))
  <div style='max-height: 300px; overflow: hidden;'>
    <img class='' src='{{ $news->image ?? asset('storage/images/default.jpg') }}' alt='{{ $news->title }}'
      style='width: 100%; height: 100%; object-fit: cover;'>
  </div>
  @endif
  {{-- Приватность новости --}}
  <div class="custom-control custom-switch my-3">
    <input type="checkbox" class="custom-control-input @if ($errors->has('isPrivate')) is-invalid @endif"
      id="news-private" name='isPrivate' @if(old('isPrivate') && old('isPrivate')==1) checked @elseif (!empty($news) &&
      $news->isPrivate==1 && !old()) checked @endif value='1'>
    <label class="custom-control-label" for="news-private">Приватная новость</label>

    @if ($errors->has('isPrivate'))

    <div class="invalid-feedback">

      @foreach($errors->get('isPrivate') as $error)

      <p>{{ $error }}</p>

      @endforeach

    </div>

    @endif

  </div>
  <button type="submit" class="btn btn-success" name='actionAdd'>Опубликовать</button>

</form>
{{-- Удаление новости --}}
@if(!empty($news))

<form action='{{ route('news.destroy', $news) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
  {{ method_field('DELETE') }}
  @csrf
  <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
</form>

@endif

@endsection