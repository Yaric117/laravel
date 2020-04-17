@section('menu')
<div class='row'>
  <ul class="nav nav-pills my-4">
    {{ $active='' }}
    <li class="nav-item">
      <a class="nav-link @if (url()->current()==route('index')) {{ $active='active' }} @endif" href="/">Главная</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('news.all') || strpos(url()->current(), 'news')) {{ $active='active' }} @endif"
        href="{{ route('news.all') }}">Все новости</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.index') }}">Админка</a>
    </li>
  </ul>
</div>
@endsection