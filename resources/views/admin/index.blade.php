<x-head></x-head>

<body class="animation">

    <x-sidebaradmin></x-sidebaradmin>

    {{-- content --}}

    <div class="main">
        <x-topbaradmin></x-topbaradmin>


        {{-- Pengguna --}}

        <div class="cardBox" id="beranda">
            <a href="{{ url('admin/user') }}">

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

            <a href="{{ route('admin.oder.index') }}">
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
                <h2>
                    Pesanan Terbaru
                </h2>
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
                        <tr>
                            <td>Abizar</td>
                            <td>Malang</td>
                            <td>Celana</td>
                            <td>Rp. 45.000</td>
                            <td>Dibayar</td>
                            <td><span class="status pending">Tertunda</span></td>
                            <td>
                                <button>Lihat</button>
                                <button>Perbarui</button>
                                <button>Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Abizar</td>
                            <td>Malang</td>
                            <td>Sepatu</td>
                            <td>Rp. 61.000</td>
                            <td>Dibayar</td>
                            <td><span class="status delivered">Terkirim</span></td>
                            <td>
                                <button>Lihat</button>
                                <button>Perbarui</button>
                                <button>Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Abizar</td>
                            <td>Malang</td>
                            <td>Baju</td>
                            <td>Rp. 74.000</td>
                            <td>Jatuh Tempo</td>
                            <td><span class="status inProgress">Dalam Pengerjaan</span></td>
                            <td>
                                <button>Lihat</button>
                                <button>Perbarui</button>
                                <button>Hapus</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Abizar</td>
                            <td>Malang</td>
                            <td>Sabuk</td>
                            <td>Rp. 16.000</td>
                            <td>Dibayar</td>
                            <td><span class="status return">Pengembalian</span></td>
                            <td>
                                <button>Lihat</button>
                                <button>Perbarui</button>
                                <button>Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

{{-- script --}}
<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
