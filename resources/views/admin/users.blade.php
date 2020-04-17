@extends('template.main')

@section('title')

Админ-панель | Пользователи

@endsection

@include('admin.menu')

@section('contents')

<div class="row">
    <a href='{{ route('user.create') }}' type="submit" class="btn btn-outline-success mb-3 @if (url()->current() == route('user.create')) d-none @endif" name='actionDelete'>Добавить пользователя</a>
    @forelse ($users as $user)
    <div class="card w-100">
        <div class="card-body">
            <div class="alert alert-light" role="alert">
                права: {{ $roles[$user->role_id]->name }}
            </div>

            <h5 class="card-title">{{ $user->name}}</h5>
            <p class="card-text">{{ $user->email}}</p>

            <a href='{{ route('user.edit', $user) }}' class="btn btn-outline-success">Редактировать</a>

            <form action='{{ route('user.destroy', $user) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
                {{ method_field('DELETE') }}
                @csrf
                <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
            </form>

        </div>
    </div>

    @empty

    <div class="alert alert-primary" role="alert">
        Нет пользователей!
    </div>

    @endforelse

</div>

@endsection