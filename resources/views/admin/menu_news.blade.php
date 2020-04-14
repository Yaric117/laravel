@section('menu_category_by_admin')
<div class='row'>
  <ul class="nav nav-pills my-4">
    {{ $active='' }}
    <li class="nav-item">
      <a class="nav-link @if (url()->current() == route('news.index')) {{ $active='active' }} @endif"
        href="{{ route('news.index') }}">Все новости</a>
    </li>
    @foreach ($categories as $link)

    <li class="nav-item">
      <a class="nav-link  @if (url()->current() == route('news.category-admin', $link)) {{ $active='active' }} @endif"
        href="{{ route('news.category-admin', $link) }}">
        {{ $link->category }}
      </a>
    </li>

    @endforeach

  </ul>
  <div class='admin-menu'>
    <ul class="nav nav-pills my-4">
      <li class="nav-item">
        <a class="nav-link @if (url()->current() == route('news.create')) {{ $active='active' }} @endif"
          href="{{ route('news.create') }}">Добавить новость</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if (url()->current() == route('news.basket')) {{ $active='active' }} @endif"
          href="{{ route('news.basket') }}">Корзина</a>
      </li>
    </ul>
  </div>
</div>

@endsection