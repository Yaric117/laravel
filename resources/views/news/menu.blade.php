@section('menu_category_by_admin')

<ul class="nav nav-pills my-4">
  {{ $active='' }}

  @foreach ($categories as $link)
  <li class="nav-item">
    <a class="nav-link  @if (url()->current() == route('news.category', $link->category_alias)) {{ $active='active' }} @endif"
      href="{{ route('news.category', $link->category_alias) }}">
      {{ $link->category }}
    </a>
  </li>
  @endforeach

</ul>

@endsection