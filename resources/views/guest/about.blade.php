<x-head></x-head>

<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">


        <div class="wrap-menu-desktop" style="top: 0;">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="images/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ url('/') }}">Beranda</a>
                        </li>

                        <li>
                            <a href="{{ url('produk') }}">Produk</a>
                        </li>

                        <li>
                            <a href="{{ url('about') }}">Tentang</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <a href="login"><button class="login-btn">Masuk</button></a>
                    <a href="register"><button class="reg-btn">Daftar</button></a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{ url('/') }}"><img src="images/logo.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15" onclick="toggleSearch()">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

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
            <li>
                <a href="{{ url('/') }}">Beranda</a>
            </li>

            <li>
                <a href="produk">Toko</a>
            </li>

            <li>
                <a href="{{ url('produk') }}">Kategori</a>
            </li>

            <li>
                <a href="{{ url('about') }}">Tentang</a>
            </li>

        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
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

<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/ospek.png'); background-position:top;">
    <h2 class="ltext-105 cl0 txt-center">
        About
    </h2>
</section>	


<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Cerita Kami
                    </h3>

                    Di Ospek Malang, kami memahami betapa pentingnya memulai perjalanan kampus Anda dengan penuh semangat dan persiapan yang matang. Itulah sebabnya kami hadir untuk menyediakan berbagai produk eksklusif yang dirancang khusus untuk membantu Anda memulai pengalaman ospek dengan gaya dan percaya diri.

                    Ospek Malang adalah destinasi utama bagi mahasiswa baru yang mencari berbagai baju dan perlengkapan ospek berkualitas tinggi. Kami menawarkan koleksi lengkap yang mencakup baju ospek, aksesori, dan perlengkapan lainnya yang diperlukan untuk membuat pengalaman ospek Anda lebih berkesan.
                    </p>

                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1 ">
                    <div class="hov-img0">
                        <img src="images/about-01.jpg" alt="IMG">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Misi Kami
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Menyediakan Produk Berkualitas: Kami berusaha keras untuk memastikan setiap produk yang kami tawarkan memenuhi standar kualitas tertinggi, memberikan nilai tambah kepada setiap pelanggan kami.
                        <br>
                        <br>
                        Memberikan Pengalaman Belanja yang Mudah: Kami berkomitmen untuk memberikan pengalaman belanja yang mudah dan menyenangkan melalui platform online yang user-friendly, dengan pelayanan pelanggan yang siap membantu setiap saat.
                        <br>
                        <br>
                        Mendukung Komunitas Mahasiswa: Kami ingin membantu mahasiswa baru merasa diterima dan siap untuk menghadapi tantangan pertama mereka dengan perlengkapan yang tepat dan penuh gaya.
                    </p>
                </div>
            </div>

            <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                <div class="how-bor2">
                    <div class="hov-img0">
                        <img src="images/about-02.jpg" alt="IMG">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	

<x-footer></x-footer>

<x-script></x-script>