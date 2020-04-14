@extends('template.main')

@section('title') 

  @parent 404 

@endsection 


@include('news.menu')


@section('contents')

<div class="alert alert-danger" role="alert">
  404. Упс, такой страницы не существует!
</div>

@endsection