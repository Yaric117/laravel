@extends('template.main')

@section('name')

    Админ-панель | Добавление новости

@endsection

@include('admin.menu')

@section('contents')

    <a href='{{ route('user.create') }}' type="submit"
       class="btn btn-outline-success mb-3 @if (url()->current() == route('user.create')) d-none @endif"
       name='actionDelete'>Добавить пользователя</a>

    @if (!empty($user))

        <div class="alert alert-light" role="alert">
            Редактирование пользователя
        </div>

    @else

        <div class="alert alert-light" role="alert">
            Добавление пользователя
        </div>

    @endif

    <form class='' action='@if(!empty($user)){{ route('user.update', $user) }}@else{{ route('user.store') }}@endif'
          enctype="multipart/form-data" method="POST">

        @if(!empty($user)) {{ method_field('PUT') }} @endif

        @csrf
        {{-- name --}}
        <div class="form-group">
            <label for="user_name">Имя*:</label>
            <input type="text" class="form-control @error ('name') is-invalid @enderror" id="user_name" name='name'
                   aria-describedby="text" value='{{ old('name') ?? $user->name ?? '' }}'>

            @if ($errors->has('name'))

                <div class="invalid-feedback">

                    @foreach($errors->get('name') as $error)

                        <p>{{ $error }}</p>

                    @endforeach

                </div>

            @else

                <small class='text-muted'>мин. 2 макс. 100 символов </small>

            @endif


        </div>
        {{-- email --}}
        <div class="form-group">
            <label for="user_email">email*:</label>
            <input type="email" class="form-control @error ('email') is-invalid @enderror" id="user_email" name='email'
                   aria-describedby="text" value='{{ old('email') ??  $user->email ?? ''  }}'>

            @if ($errors->has('email'))

                <div class="invalid-feedback">

                    @foreach($errors->get('email') as $error)

                        <p>{{ $error }}</p>

                    @endforeach

                </div>

            @else

                <small class='text-muted'>макс. 255 символов</small>

            @endif


        </div>
        {{-- Role --}}
        <select class="custom-select my-3 @error ('role_id') is-invalid @enderror" name='role_id'>
            <option>Выберете роль:*</option>

            @forelse ($roles as $role)

                <option @if (!empty($user) && old('role_id')==$role->id || !empty($user) && $user->role_id == $role->id)
                        selected @elseif (empty($user) && $role->id == old('role_id')) selected @endif
                        value="{{ $role->id }}">{{ $role->name}}</option>

            @empty

                <option disabled>категории не добавлены</option>

            @endforelse

        </select>

        @if ($errors->has('role_id'))

            <div class="invalid-feedback">

                @foreach($errors->get('role_id') as $error)

                    <p>{{ $error }}</p>

                @endforeach

            </div>

        @endif

        {{--PASSWORD --}}

        @if(!empty($user))

            <a href="{{ route('user.edit-password', $user) }}" class="btn btn-outline-secondary" name='actionDelete'>Сменить пароль</a>

        @else

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

        @endif


        <button type="submit" class="btn btn-success" name='actionAdd'>Сохранить</button>

    </form>
    {{-- Удаление user --}}
    @if(!empty($user))

        <form action='{{ route('user.destroy', $user) }}' enctype="multipart/form-data" method="POST" class='mt-3'>
            {{ method_field('DELETE') }}
            @csrf
            <button type="submit" class="btn btn-outline-danger" name='actionDelete'>Удалить</button>
        </form>

    @endif

@endsection
