<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">


        <div class="wrap-menu-desktop" style="top: 0;">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="{{ url('images/logo.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ url('/user') }}">Beranda</a>
                        </li>

                        <li>
                            <a href="{{ url('/user#about') }}">Tentang</a>
                        </li>

                        <li>
                            <a href="{{ url('user/product') }}">Produk</a>
                        </li>

                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <form action="" class="search">
                            <input type="search" name="" placeholder="Cari..." id="search"
                                class="search-input">
                            <button type="submit" class="search-btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>

                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                        data-notify="{{ $cartCount }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>


                    <a href="">
                        <div class="profile-image">
                            @if (Auth::user()->image)
                                <img src="{{ asset(Auth::user()->image) }}" alt="User Image">
                            @else
                                <img src="{{ url('images/default-profile.jpg') }}" alt="Default Image">
                            @endif

                            <ul class="menu-profil">
                                <li class="profil-list">
                                    <a href="#">
                                        <span class="tittle">
                                            Edit Profil
                                        </span>
                                    </a>
                                </li>
                                <li class="profil-list">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="tittle">Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" alt="IMG-LOGO"></a>
        </div>

        <div class="flex-w flex-c-m m-tb-10">

            <div class="flex-c-m  pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
            </div>
        </div>

        <!-- Search product -->
        <div class="dis-none panel-search w-full p-t-10 p-b-15">
            <div class="bor8 dis-flex p-l-1">
                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>

                <form action="">
                    <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                </form>
            </div>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m" onclick="toggleSearch()">

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="{{ $cartCount }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <a href="#">
            <div class="profile-image">
                @if (Auth::user()->image)
                    <img src="{{ asset(Auth::user()->image) }}" alt="User Image">
                @else
                    <img src="{{ url('images/default-profile.jpg') }}" alt="Default Image">
                @endif

                <ul class="menu-profil">
                    <li class="profil-list">
                        <a href="#">
                            <span class="tittle">
                                Edit Profil
                            </span>
                        </a>
                    </li>
                    <li class="profil-list">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="tittle">Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">


        <ul class="main-menu-m">
            <li class="active-menu">
                <a href="{{ url('/user') }}">Beranda</a>
            </li>

            <li>
                <a href="{{ url('/user#about') }}">Tentang</a>
            </li>

            <li>
                <a href="{{ url('user/product') }}">Produk</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{ url('images/icons/icon-close2.png') }}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Cari...">
            </form>
        </div>
    </div>
</header>