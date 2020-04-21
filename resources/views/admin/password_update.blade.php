@extends('template.main')

@section('name')

    Админ-панель | Добавление новости

@endsection

@include('admin.menu')

@section('contents')

    <a href='{{ route('user.create') }}' type="submit"
       class="btn btn-outline-success mb-3 @if (url()->current() == route('user.create')) d-none @endif"
       name='actionDelete'>Добавить пользователя</a>
    <div class="alert alert-light" role="alert">
        Смена пароля пользователя
    </div>
    <form class='' action='{{ route('user.update-password', $user) }}'
          enctype="multipart/form-data" method="POST">
        {{ method_field('PUT') }}
        @csrf
        {{-- password --}}
        <div class="form-group">
            <label for="user_pass">пароль*:</label>
            <input type="password" class="form-control @error ('password') is-invalid @enderror" id="user_pass"
                   name='password' aria-describedby="text" autocomplete="new-password">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    @foreach($errors->get('password') as $error)
                        <p>{{ $error }}</p>
                        <p>Случайный пароль: {{ str_random(8) }}</p>
                    @endforeach
                </div>
            @else
                <small class='text-muted'>мин. 3 символа. Случайный пароль: {{ str_random(8) }}</small>
            @endif

        </div>

        {{-- password-confirm --}}

        <div class="form-group">
            <label for="user_pass_confirm">Повторите пароль*:</label>
            <input type="password" class="form-control" id="user_pass_confirm" name='password_confirmation'
                   aria-describedby="text" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-success" name='actionAdd'>Спенить пароль</button>
    </form>
@endsection
