<x-head></x-head>

<body>
    @include('components.userheader')
    <!-- Alamat Pengiriman -->
    <div class="checkout-section">
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

                                <div class="header-cart-item-img"
                                    onclick="document.getElementById('delete-item-{{ $item->id }}').submit();">
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
                                        {{ $item->quantity }} x
                                        {{ number_format($item->product->price, 0, ',', '.') }}
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
                                Lainnya
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

        <div class="container" style="margin-top:120px;">
            <h1>Pilih Barang untuk Checkout</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="" method="POST">
                @csrf

                <table class="table mt-5" style=" border-spacing: 0 10px; border-color:transparent;">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th></th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr>
                                <td>
                                    <input type="checkbox" class="item-checkbox"
                                        data-price="{{ $item->product->price }}"
                                        data-quantity="{{ $item->quantity }}">
                                </td>
                                <td style="text-align: center;"><img src="{{ asset('images/' . $item->product->image1) }}" alt="Product Image 1"
                                        style="width: 100px; height: 100px;object-fit:contain">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Keranjang belanja kosong.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Area untuk menampilkan total harga -->
                <div class="d-flex align-items-center float-end mt-5" style="position: fixed; right:100px; bottom:100px;">
                    <button type="submit" class="btn btn-primary">Proses Checkout</button>
                    <h3 class="ml-4">Total Harga: Rp. <span id="total-price">0</span></h3>
                </div>

            </form>

        </div>

    </div>


    <x-script></x-script>
