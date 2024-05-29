<header>
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <a href="{{ url('/') }}" class="logo">
                    <h3 class="app-name">GAMMA <span>SHOP</span></h3>
                </a>

                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ url('/shop') }}">Shop</a>
                        </li>
                        @if ((! request()->session()->exists('id_pembeli')) && (! request()->session()->exists('id_pelapak')))
                        <li>
                            <a href="{{ route('shop.customer.login') }}">Login</a>
                        </li>
                        @endif
                        @if (request()->session()->exists('id_pembeli') && (! request()->session()->exists('id_pelapak')))
                        <li>
                            <a href="{{ url('/customer/account') }}">Akun Saya</a>
                        </li>
                        <li>
                            <a href="{{ route('shop.customer.logout') }}">Keluar</a>
                        </li>
                        @endif
                        @if (! request()->session()->exists('id_pembeli') && !request()->session()->exists('id_pelapak'))
                        <li>
                            <a href="{{ route('shop.seller.login') }}">Toko Saya</a>
                        </li>
                        @endif
                        @if ((! request()->session()->exists('id_pembeli')) && request()->session()->exists('id_pelapak'))
                        <li>
                            <a href="{{ route('shop.seller.mystore') }}">Toko Saya</a>
                        </li>
                        <li>
                            <a href="{{ route('shop.seller.order_list') }}">Pesanan Baru</a>
                        </li>
                        <li>
                            <a href="{{ route('shop.seller.logout') }}">Keluar</a>
                        </li>
                        @endif
                    </ul>
                </div>	

                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    @if (request()->session()->has('id_pembeli'))
                    @php
                    $favorites_count    = isset($favorites) ? count($favorites) : 0;
                    $carts_count        = isset($carts) ? count($carts) : 0;
                    @endphp

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ $carts_count }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-wishlist" data-notify="{{ $favorites_count }}">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </div>
                    @endif
                </div>
            </nav>
        </div>	
    </div>

    <div class="wrap-header-mobile">

        <div class="logo-mobile">
            <h3 class="app-name">G<span>M</span></h3>
        </div>

        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>
            @if (request()->session()->has('id_pembeli'))
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{ $carts_count }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
            <div class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-wishlist" data-notify="{{ $favorites_count }}">
                <i class="zmdi zmdi-favorite-outline"></i>
            </div>
            @endif
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

    <div class="menu-mobile">
        <ul class="main-menu-m">
        <li>
            <a href="{{ url('/') }}">Home</a>
        </li>
        <li>
            <a href="{{ url('/shop') }}">Shop</a>
        </li>
        @if ((! request()->session()->exists('id_pembeli')) && (! request()->session()->exists('id_pelapak')))
        <li>
            <a href="{{ route('shop.customer.login') }}">Login</a>
        </li>
        @endif
        @if (request()->session()->exists('id_pembeli') && (! request()->session()->exists('id_pelapak')))
        <li>
            <a href="{{ url('/customer/account') }}">Akun Saya</a>
        </li>
        <li>
            <a href="{{ route('shop.customer.logout') }}">Keluar</a>
        </li>
        @endif
        @if (! request()->session()->exists('id_pembeli') && !request()->session()->exists('id_pelapak'))
        <li>
            <a href="{{ route('shop.seller.login') }}">Toko Saya</a>
        </li>
        @endif
        @if ((! request()->session()->exists('id_pembeli')) && request()->session()->exists('id_pelapak'))
        <li>
            <a href="{{ route('shop.seller.mystore') }}">Toko Saya</a>
        </li>
        <li>
            <a href="{{ route('shop.seller.order_list') }}">Pesanan Baru</a>
        </li>
        <li>
            <a href="{{ route('shop.seller.logout') }}">Keluar</a>
        </li>
        @endif
        </ul>
    </div>

    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ asset('/cs/images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15" action="{{ url('shop/search') }}">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="query" placeholder="Cari...">
            </form>
        </div>
    </div>
</header>