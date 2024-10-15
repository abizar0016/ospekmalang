<x-head></x-head>

<body>
    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>

        <div class="cardBox" id="beranda">
            <a href="{{ route('admin.user') }}">
                <div class="card">
                    <div class="">
                        <div class="numbers">{{ $userCount }}</div>
                        <div class="cardName">Pengguna</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.product.index') }}">
                <div class="card">
                    <div class="">
                        <div class="numbers">{{ $productCount }}</div>
                        <div class="cardName">Produk</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="cube-outline"></ion-icon>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="card">
                    <div class="">
                        <div class="numbers">{{ $orderCount }}</div>
                        <div class="cardName">Pesanan</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>
            </a>
        </div>

        <div class="detail">
            <div class="cardHeader">
                <h2>Pesanan Terbaru</h2>
            </div>

            <div class="recentOrders">
                <table>
                    <thead>
                        <tr>
                            <td>Pembeli</td>
                            <td>Kota</td>
                            <td>Barang</td>
                            <td>Harga</td>
                            <td>Pembayaran</td>
                            <td>Status</td>
                            <td colspan="3">Aksi</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->user->uname }}</td>
                            <td>{{ $order->user->city }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>Rp. {{ number_format($order->product->price, 0, ',', '.') }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td><span class="status {{ strtolower($order->order_status) }}">{{ $order->order_status}}</span></td>
                            <td>
                                <a href=""><button><ion-icon name="pencil-outline"></ion-icon></button></a>
                                <form action="" method="POST" style="display:inline;" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

<x-script></x-script>
<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
