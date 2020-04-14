@extends('template.main')

@section('title')

Админ.панель | Главная

@endsection

@include('admin.menu')

@section('contents')

<div class="alert alert-success" role="alert">
    Это главная страница админ-панели!
  </div>

@endsection