<nav>
    <div class="navbar-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-brand">
            <span style="font-size: 1.875rem;">🎁</span>
            <span>ArtistShack</span>
        </a>

        <!-- Menu -->
        <ul class="navbar-menu">
            <li><a href="{{ route('shop.index') }}">Shop</a></li>
            <li class="dropdown">
                <a href="#">Categories</a>
                <div class="dropdown-menu">
                    @foreach($categories ?? [] as $category)
                        <a href="{{ route('shop.category', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>

        <!-- Right side -->
        <div class="navbar-right">
            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="relative">
                <span style="font-size: 1.5rem;">🛒</span>
                @auth
                    <span class="cart-badge">{{ auth()->user()->cartItems()->count() }}</span>
                @endauth
            </a>

            <!-- User Menu -->
            @auth
                <div class="dropdown">
                    <button style="background: none; border: none; color: white; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; font-weight: 600;">
                        👤 {{ auth()->user()->name }}
                    </button>
                    <div class="dropdown-menu" style="right: 0; left: auto;">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}">📊 Admin Dashboard</a>
                        @endif
                        <a href="{{ route('orders.index') }}">📦 My Orders</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                            @csrf
                            <button type="submit" style="background: none; border: none; cursor: pointer; width: 100%; text-align: left; padding: 0.75rem 1rem; color: var(--gray-800);">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="font-size: 0.875rem;">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>