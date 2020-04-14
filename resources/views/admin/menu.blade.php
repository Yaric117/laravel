@section('menu')
<div class='admin-menu row'>
  <ul class="nav nav-pills my-4">
    {{ $active='' }}
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('admin.index')) {{ $active='active' }} @endif" href="{{ route('admin.index') }}">Главная</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('news.index')||strpos(url()->current(), 'manager/news')) {{ $active='active' }} @endif"
        href="{{ route('news.index') }}">Редактор новостей</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/">Перейти на
        сайт</a>
    </li>
  </ul>
</div>
<style>
  .admin-menu ul li a {
    color: #38c172 !important;
  }

  .admin-menu ul li .active {
    color: #fff !important;
    background-color: #38c172 !important;
  }
</style>

@endsection