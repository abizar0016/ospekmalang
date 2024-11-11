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
                        @foreach ($Items as $item)
                            <li class="header-cart-item flex-w flex-t m-b-12">

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
                                $Items->sum(function ($item) {
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

        <div class="container checkout-container" style="margin-top:120px;">
            <h1>Pilih Barang untuk Checkout</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <table class="table mt-5" style="border-spacing: 0 10px; border-color: transparent;">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga Barang</th>
                        <th>Aksi</th> <!-- Column for delete button -->
                        <th style="display: flex; justify-content:space-around">Pilih Semua <input type="checkbox"
                                id="select-all" onchange="toggleSelectAll()"></th> <!-- Checkbox on the right -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Items as $cart)
                        <tr>
                            <td style="text-align: center;">
                                <img src="{{ asset('images/' . $cart->product->image1) }}" alt="Product Image 1"
                                    style="width: 100px; height: 100px; object-fit: contain;">
                            </td>
                            <td>{{ $cart->product->name }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp. {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form id="delete-cart-{{ $cart->id }}"
                                    action="{{ route('user.checkout.delete', $cart->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-cart-button" type="button"
                                        data-form-id="delete-cart-{{ $cart->id }}">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                            <td>
                                <input type="checkbox" class="cart-checkbox" data-id="{{ $cart->product->id }}"
                                    data-price="{{ $cart->product->price }}" data-quantity="{{ $cart->quantity }}"
                                    onchange="updateTotal()">
                            </td>   
                        </tr>
                    @empty
                        <tr>
                            <td style="text-align: center" colspan="7">Keranjang belanja kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="checkout-total-bar">
            <button type="button" class="btn    " onclick="showPaymentModal()">Lanjutkan Pembayaran</button>
            <h3 class="ml-4">Total Harga: Rp. <span id="total-price">0</span></h3>
        </div>
    </div>

     <!-- Modal for Payment Information -->
     <div id="paymentModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closePaymentModal()">&times;</span>
            <h2>Informasi Pembayaran</h2>
            <form id="paymentForm" action="{{ route('user.payment.process') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="recipientName">Nama Penerima:</label>
                    <input type="text" id="recipientName" name="recipient_name" required>
                </div>
                <div class="form-group">
                    <label for="recipientPhone">Nomor Penerima:</label>
                    <input type="text" id="recipientPhone" name="recipient_phone" required>
                </div>
                <div class="form-group">
                    <label for="recipientAddress">Alamat Penerima:</label>
                    <textarea id="recipientAddress" name="recipient_address" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Bayar</button>
            </form>
        </div>
    </div>

</body>

<x-script></x-script>
