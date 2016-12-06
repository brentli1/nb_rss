<nav class="main-nav">
  <div class="main-nav__logo">
    NB<span class="main-nav__emp">RSS</span>
  </div>
  <ul class="main-nav__items">
    @if (Auth::guest())
    <li class="main-nav__item">
      <a href="{{ url('/login') }}" class="main-nav__item-link">Login</a>
    </li>
    <li class="main-nav__item">
      <a href="{{ url('/register') }}" class="main-nav__item-link">Register</a>
    </li>
    @else
    <li class="main-nav__item">Hello, <span class="main-nav__emp">{{ Auth::user()->name }}</span></li>
    <li class="main-nav__item">
      <a href="{{ url('/logout') }}" class="main-nav__item-link">Logout</a>
    </li>
    @endif
  </ul>
</nav>