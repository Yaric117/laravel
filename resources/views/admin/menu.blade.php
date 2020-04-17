@section('menu')
<div class='admin-menu row justify-content-between'>
  <ul class="nav nav-pills my-4">
    {{ $active='' }}
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('admin.index')) {{ $active='active' }} @endif"
        href="{{ route('admin.index') }}">Главная</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('news.index')||strpos(url()->current(), 'manager/news')) {{ $active='active' }} @endif"
        href="{{ route('news.index') }}">Редактор новостей</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('user.index')) {{ $active='active' }} @endif"
        href="{{ route('user.index') }}">Пользователи</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/">Перейти на
        сайт</a>
    </li>
  </ul>

  {{-- Авторизация --}}

  <ul class="nav nav-pills my-4 user">
    @guest
    <li class="nav-item">
      <a class="nav-link @if (url()->current()==route('login')) d-none @endif" href="{{ route('login') }}">Войти</a>
    </li>
    @if (Route::has('register'))
    <li class="nav-item">
      <a class="nav-link @if (url()->current()==route('register')) d-none @endif"
        href="{{ route('register') }}">{{ __('Регистрация') }}</a>
    </li>
    @endif
    @else
    <li class="nav-item dropdown">

      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" v-pre>
        {{ Auth::user()->name }} <span class="caret"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

        @if(Auth::user()->role_id===1||Auth::user()->role_id===2)

        <a class="dropdown-item" href="{{ route('admin.index') }}">
          {{ __('Админка') }}
        </a>

        @endif

        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
          {{ __('Выйти') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
    @endguest

  </ul>
</div>

@endsection