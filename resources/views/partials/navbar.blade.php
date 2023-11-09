<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                @auth
                <li class="nav-item cta cta-colored dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-person"></span></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="cart.html"><span class="icon-person"></span> Profile</a>
                        <a class="dropdown-item" href="{{ route('cart') }}"><span class="icon-shopping_cart"></span> Cart</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <span class="icon-arrow-circle-o-right"></span> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
                @guest
                <li class="nav-item cta cta-colored"><a href="{{ route('login') }}" class="nav-link"><span class="icon-arrow-circle-right"></span> Login</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>