@extends('template.main')
@section('title')

@parent Главная

@endsection

@include('menu')

@section('contents')

<div class="alert alert-success" role="alert">
  Это главная страница!
</div>

@endsection