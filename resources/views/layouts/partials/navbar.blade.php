<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="{{ route('index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" style="max-height: 35px">
        </a>

        <span class="navbar-brand waves-effect">
                    Laravel-Shop
                </span>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ route('catalog.index') }}">Catalog</a>
                </li>
            </ul>
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons ms-auto">
                @if(Cart::count() > 0)
                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="nav-link waves-effect">
                            <span class="badge text-bg-danger z-depth-1 mr-1">{{ Cart::count() }}</span>
                            <i class="fa fa-shopping-cart"></i>
                            <span class="clearfix d-none d-sm-inline-block">Cart</span>
                        </a>
                    </li>
                @endif
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    @if(Auth::user()->is_admin)
                        <li class="nav-item">
                            <a href="{{ route('admin.index') }}" class="nav-link">Admin Panel</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->
