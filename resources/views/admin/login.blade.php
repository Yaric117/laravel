@extends('template.main')
@section('title', 'Логин')

@section('contents')

<form class='mt-4'>
  <div class="form-group">
    <label for="exampleInputEmail1">Логин:</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">введите ваш логин</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Пароль:</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
  </div>
  <button type="submit" class="btn btn-primary">Вход</button>
</form>

@endsection