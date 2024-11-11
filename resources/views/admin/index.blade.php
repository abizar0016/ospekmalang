<x-head></x-head>
<link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}">

<body>
    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>

        <div class="cardBox" id="beranda">
            <a href="{{ route('admin.user') }}">
                <div class="card">
                    <div class="card-item">
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
            <div class="cardHeader mt-5">
                <h2>Pesanan Terbaru</h2>
                <a class="link" href="{{ route('admin.order.index') }}">Lihat Semua Pesanan</a>
            </div>

            <div class="recentOrders">
                <table>
                    <thead>
                        <tr>
                            <th>Pembeli</th>
                            <th>Kota</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th class="aksi" colspan="3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($recentOrders->take(5) as $order)
                            <tr>
                                <td>{{ $order->user->uname }}</td>
                                <td>{{ $order->user->city }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>Rp. {{ number_format($order->product->price, 0, ',', '.') }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td><span
                                        class="status {{ strtolower($order->order_status) }}">{{ $order->order_status }}</span>
                                </td>
                                <td>
                                    <button onclick="openModal('modal-view-{{ $order->id }}')" class="aksi-button">
                                        Lihat
                                    </button>
                                    <button onclick="openModal('modal-update-{{ $order->id }}')"
                                        class="aksi-button">
                                        Edit
                                    </button>
                                    <form id="order-delete-{{ $order->id }}"
                                        action="{{ route('admin.order.delete', $order->id) }}" method="POST"
                                        style="display:inline;" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="aksi-button delete-order-button"
                                            data-form-id="order-delete-{{ $order->id }}"
                                            data-item-name="{{ $order->name }}">
                                            Hapus
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

    @foreach ($orders as $order)
        <!-- Modal for Viewing Order -->
        <div class="modal" id="modal-view-{{ $order->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-view-{{ $order->id }}')">&times;</button>
                <h2>Detail Pesanan</h2>

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <button class="tab-button active"
                        onclick="openTab(event, 'OrderDetails-{{ $order->id }}')">Detail Pesanan</button>
                    <button class="tab-button" onclick="openTab(event, 'UserDetails-{{ $order->id }}')">Detail
                        Pengguna</button>
                </div>

                <!-- Tab Content -->

                <!-- Tab Detail Pesanan -->
                <div id="OrderDetails-{{ $order->id }}" class="tab-content active">
                    <form>
                        <div class="input-row">
                            <div class="input-grup">
                                <label for="name">Nama Pembeli :</label>
                                <input type="text" name="name" value="{{ $order->user->uname }}" readonly>
                            </div>
                            <div class="input-grup">
                                <label for="product_name">Nama Barang :</label>
                                <input type="text" name="product_name" value="{{ $order->product->name }}" readonly>
                            </div>
                        </div>


                        <label for="order_date">Waktu Memesan :</label>
                        <input type="text" name="order_date"
                            value="{{ \Carbon\Carbon::parse($order->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }}"
                            readonly>

                        <div class="input-row">
                            <div class="input-grup">
                                <label for="payment_status">Status Pembayaran :</label>
                                <input type="text" name="payment_status" value="{{ $order->payment_status }}"
                                    readonly>
                            </div>
                            <div class="input-grup">
                                <label for="order_status">Status Pesanan :</label>
                                <input type="text" name="order_status" value="{{ $order->order_status }}" readonly>
                            </div>
                        </div>


                        <label for="address">Alamat Pengiriman :</label>
                        <textarea name="address" readonly>{{ $order->alamat }}</textarea>
                    </form>
                </div>

                <!-- Tab Detail Pengguna -->
                <div id="UserDetails-{{ $order->id }}" class="tab-content">
                    <form>
                        <div class="input-row">

                            <div class="input-grup">

                                <label>Gambar Profil:</label>

                                <div class="image-profile">

                                    <img src="{{ $order->user->image ? asset($order->user->image) : asset('images/default-profile.jpg') }}"
                                        alt="Profil Pengguna">

                                </div>
                            </div>


                            <div class="input-grup">

                                <label for="uname">Nama:</label>

                                <input type="text" name="uname" value="{{ $order->user->uname }}" readonly>


                                <label for="email">Email:</label>

                                <input type="email" name="email" value="{{ $order->user->email }}" readonly>

                            </div>

                        </div>


                        <label for="phone">Nomor Telepon:</label>
                        <input type="text" name="phone" value="{{ $order->user->phone }}" readonly>

                        <div class="input-row">
                            <div class="input-grup">
                                <label for="city">Kota:</label>
                                <input type="text" name="city" value="{{ $order->user->city }}" readonly>
                            </div>
                            <div class="input-grup">
                                <label for="status">Status:</label>
                                <input type="text" name="status" value="{{ $order->user->status }}" readonly>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>


        <!-- Modal for Updating Order -->
        <div class="modal" id="modal-update-{{ $order->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-update-{{ $order->id }}')">&times;</button>
                <h2>Update Pesanan</h2>
                <form action="{{ route('admin.order.update', $order->id) }}" id="order-update-{{ $order->id }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <label for="payment_status">Status Pembayaran :</label>
                    <select name="payment_status" required>
                        <option value="dibayar" {{ $order->payment_status === 'dibayar' ? 'selected' : '' }}>Dibayar
                        </option>
                        <option value="jatuh tempo" {{ $order->payment_status === 'jatuh tempo' ? 'selected' : '' }}>
                            Jatuh Tempo</option>
                        <option value="belum dibayar"
                            {{ $order->payment_status === 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                    </select>

                    <label for="order_status">Status Pesanan :</label>
                    <select name="order_status" required>
                        <option value="tertunda" {{ $order->order_status === 'tertunda' ? 'selected' : '' }}>Tertunda
                        </option>
                        <option value="dikirim" {{ $order->order_status === 'dikirim' ? 'selected' : '' }}>Dirkirim
                        </option>
                        <option value="dikerjakan" {{ $order->order_status === 'dikerjakan' ? 'selected' : '' }}>
                            Dikerjakan
                        </option>
                        <option value="dikembalikan" {{ $order->order_status === 'dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan
                        </option>
                    </select>

                    <button type="submit" class="submit-btn">Kirim</button>
                </form>
            </div>
        </div>
    @endforeach

</body>

<x-script></x-script>
<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
