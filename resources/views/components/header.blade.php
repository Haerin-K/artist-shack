<!-- ===== HEADER NAVIGATION ===== -->
<header class="header-section">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="navbar-brand">
                <i class="fa fa-gift"></i> The Artist Shack
            </a>

            <!-- Toggle Menu Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Shop Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">
                            <i class="fa fa-shopping-bag"></i> Shop
                        </a>
                    </li>

                    <!-- Categories Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-list"></i> Categories
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @foreach($categories ?? [] as $category)
                                <a class="dropdown-item" href="{{ route('shop.category', $category->slug) }}">
                                    <i class="fa fa-folder"></i> {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <!-- Cart Link -->
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fa fa-shopping-cart"></i> Cart
                            @auth
                                @php $cartCount = auth()->user()->cartItems()->count(); @endphp
                                @if($cartCount > 0)
                                    <span class="badge badge-danger position-absolute" style="top: -5px; right: -10px;">{{ $cartCount }}</span>
                                @endif
                            @endauth
                        </a>
                    </li>

                    <!-- User Menu -->
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ auth()->user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                @if(auth()->user()->isAdmin())
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="fa fa-tachometer"></i> Admin Dashboard
                                    </a>
                                    <div class="dropdown-divider"></div>
                                @endif
                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                    <i class="fa fa-box"></i> My Orders
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="background: none; border: none; cursor: pointer; text-align: left;">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-sign-in"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fa fa-user-plus"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
