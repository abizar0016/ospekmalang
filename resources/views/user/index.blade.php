<x-head></x-head>

<body class="animsition">

    <!-- Header -->
    @include('components.userheader')
    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Keranjang Anda
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    @foreach ($cartItems as $item)
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <form id="delete-item-{{ $item->id }}"
                                action="{{ route('user.cart.delete', $item->id) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <div class="header-cart-item-img delete-item" data-item-id="{{ $item->id }}"
                                data-item-name="{{ $item->product->name }}">
                                <img src="{{ asset('images/' . $item->product->image1) }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt">
                                <p class="header-cart-item-name m-b-1 hov-cl1 trans-04">
                                    {{ $item->product->name }}
                                </p>

                                <span class="header-cart-item-info">
                                    Size: {{ $item->product->size ?? '-' }}
                                </span>

                                <span class="header-cart-item-info">
                                    {{ $item->quantity }} x {{ number_format($item->product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: Rp
                        {{ number_format(
                            $cartItems->sum(function ($item) {
                                return $item->product->price * $item->quantity;
                            }),
                            0,
                            ',',
                            '.',
                        ) }}
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="{{ route('user.product') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Tambah
                        </a>

                        <a href="{{ route('user.checkout') }}"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Checkout
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1" style="background-image: url({{ url('images/bg-slide2.png') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Baju Hitam & Putih
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Baju Ospek
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{ route('user.product') }}"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url({{ url('images/bg-slide3.png') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Perlengkapan Ospek
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn"
                                data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Sepatu & Dasi
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                <a href="{{ route('user.product') }}"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-slick1" style="background-image: url({{ url('images/bg-slide.png') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft"
                                data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Aksesoris Lainnya
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight"
                                data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Ospek Lainnnya
                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                <a href="{{ route('user.product') }}"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Belanja Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg0 p-t-75 p-b-120" id="about">
        <div class="container">
            <div class="row p-b-148">
                <div class="col-md-7 col-lg-8">
                    <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                        <h3 class="mtext-111 cl2 p-b-16">
                            Cerita Kami
                        </h3>

                        Di Ospek Malang, kami memahami pentingnya memulai perjalanan kampus dengan semangat dan
                        persiapan yang matang. Kami hadir menyediakan berbagai produk eksklusif untuk membantu Anda
                        memulai ospek dengan gaya dan percaya diri. Sebagai destinasi utama mahasiswa baru, Ospek Malang
                        menawarkan koleksi lengkap baju ospek, aksesori, dan perlengkapan berkualitas tinggi yang
                        dibutuhkan untuk pengalaman ospek yang berkesan. Kami berkomitmen menyediakan produk berkualitas
                        dengan standar tinggi, pengalaman belanja yang mudah melalui platform online yang user-friendly,
                        serta dukungan pelanggan yang siap membantu. Kami juga mendukung komunitas mahasiswa dengan
                        memastikan setiap pelanggan baru merasa diterima dan siap menghadapi tantangan awal mereka
                        dengan perlengkapan yang penuh gaya.

                    </div>
                </div>

                <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                    <div class="hov-img0">
                        <img src="{{ url('images/foto-about-2.png') }}" alt="IMG">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('images/baju.png') }}" alt="IMG-BANNER" style="height: 525px; width:390px">

                        <a href="{{ route('user.product') }}"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Baju
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Hitam Putih
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Belanja Sekarang
                                </div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('images/celana.png') }}" alt="IMG-BANNER" style="height: 525px; width:390px">

                        <a href="{{ route('user.product') }}"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Celana
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Celana Hitam
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Belanja Sekarang
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('images/sabuk.png') }}" alt="IMG-BANNER" style="height: 525px; width:390px">

                        <a href="{{ route('user.product') }}"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Aksesoris
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Perlengkapan
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Belanja Sekarang
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140 m-t-50">
        <div class="container">
            <!-- Product Grid -->

            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Ringkasan Produk
                </h3>
            </div>

            <!-- Filter Buttons -->
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 filter-button active" data-filter="*">
                    Semua Produk
                </button>
                <div class="category-buttons">
                    @foreach ($categories as $categories)
                        <button class="filter-button stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                            data-filter="{{ $categories->id }}">
                            {{ $categories->name }}
                        </button>
                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Cari
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <form action="">
                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                                placeholder="Search">
                        </form>
                    </div>
                </div>
            </div>



            <div class="products-container mt-4">

                @foreach ($products->take(8) as $product)
                    <div class="isotope-item {{ $product->categories->id }} js-show-modal1"
                        onclick="showModal({{ $product->id }})">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ url('images/' . $product->image1) }}" alt="IMG-PRODUCT">
                            </div>
                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l">
                                    <a href="product-detail.html"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $product->name }}
                                    </a>
                                    <span class="stext-105 cl3">
                                        Rp. {{ $product->price }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="{{ url('user/product') }}"
                    class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Lainnya
                </a>
            </div>

        </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Kategori
                    </h4>

                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Baju
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Celana
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Sepatu
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Aksesoris
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        MENGHUBUNGI
                    </h4>

                    <p class="stext-107 cl7 size-201">
                        Ada Pertanyaan? Jl. Danau Surubek, Jawa Timur, Indonesia or call us on (+62) 819-1627-0743
                    </p>

                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Buletin
                    </h4>

                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                                placeholder="email@example.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>

                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="p-t-40">

                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    @ospekmalang
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
    </footer>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!-- Modal1 -->
    @foreach ($products as $product)
        <div class="wrap-modal1 js-modal1 p-t-60 p-b-20 {{ $loop->first ? 'modal-open' : '' }}"
            id="modal-{{ $product->id }}">
            <div class="overlay-modal1 js-hide-modal1"></div>
            <div class="container">
                <div class=" bg0 p-t-20 p-b-20 p-lr-15-lg how-pos3-parent">
                    <div class="product-container">
                        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                            <img src="{{ url('images/icon-close.png') }}" alt="CLOSE">
                        </button>
                        <!-- Modal content here -->
                        <ul class="image-list">
                            <li class="image-list-items">
                                <img src="{{ asset('images/' . $product->image1) }}" alt="Image 1"
                                    onclick="changeImage('{{ asset('images/' . $product->image1) }}', {{ $product->id }})">
                            </li>
                            <li class="image-list-items">
                                <img src="{{ asset('images/' . $product->image2) }}" alt="Image 2"
                                    onclick="changeImage('{{ asset('images/' . $product->image2) }}', {{ $product->id }})">
                            </li>
                            <li class="image-list-items">
                                <img src="{{ asset('images/' . $product->image3) }}" alt="Image 3"
                                    onclick="changeImage('{{ asset('images/' . $product->image3) }}', {{ $product->id }})">
                            </li>
                        </ul>
                        <div class="image-product">
                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ asset('images/' . $product->image1) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img id="mainProductImage-{{ $product->id }}"
                                            src="{{ asset('images/' . $product->image1) }}" alt="IMG-PRODUCT">
                                            <a id="mainProductLink-{{ $product->id }}"
                                                href="{{ asset('images/' . $product->image1) }}">
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-5 p-b-30">
                            <div class="p-r-50 p-t-5 p-lr-0-lg product-list">
                                <h4 class="name-product" id="modal-product-name">
                                    {{ $product->name }}
                                </h4>

                                <span class="price-product">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>

                                <p class="description-product text-disabled" id="modal-product-description">
                                    {{ $product->descriptions }}
                                </p>

                                <div class="p-t-33">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" name="quantity" class="text-disabled" value="1"
                                            min="1" max="{{ $product->stock }}">
                                        <button type="submit" class="add-btn hov-btn1">Tambah</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <x-script></x-script>
