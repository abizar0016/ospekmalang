<header>
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
                            <input type="search" placeholder="Cari..." class="search-input">
                            <button type="submit" class="search-btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                        data-notify="{{ $cartCount }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <!-- Profile dropdown menu -->
                    <div class="profile-image">
                        @if (Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image) }}" alt="User Image">
                        @else
                            <img src="{{ url('images/default-profile.jpg') }}" alt="Default Image">
                        @endif
                        <ul class="menu-profil">
                            <a href="{{ route('user.profile') }}">
                            <li class="profil-list">
                                    <span class="tittle">Edit Profil</span>
                                </li>
                            </a>
                            @auth
                            @if (Auth::user()->status === 'admin')
                            <a href="{{ route('admin.index') }}">
                                <li class="profil-list">
                                        <span>Panel Admin</span>
                                    </li>
                                </a>
                            @endif
                        @endauth
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <li class="profil-list">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                                    <span class="tittle">Keluar</span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
