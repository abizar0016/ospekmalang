<x-head></x-head>

<body class="animation">

    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="detail">
            <div class="cardHeader">
                <h2>Pesanan</h2>
            </div>
            <div class="user" id="user">
                <table>
                    <thead>
                        <tr>
                            <td>Nama Pembeli</td>
                            <td>Nama Barang</td>
                            <td>Waktu Memesan</td>
                            <td>Status Pembayaran</td>
                            <td>Status Pengiriman</td>
                            <td colspan="3">Aksi</td>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($orders->isEmpty())
                            <tr>
                                <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Orderan
                                    Sekarang</td>
                            </tr>
                        @else
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->uname }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>Rp. {{ $order->payment_status }}</td>
                                    <td><span
                                            class="status {{ strtolower($order->order_status) }}">{{ $order->order_status }}</span>
                                    </td>
                                    <td>
                                        <button onclick="openModal('modal-view-{{ $order->id }}')">
                                            <ion-icon name="eye-outline"></ion-icon>
                                        </button>
                                        <button onclick="openModal('modal-update-{{ $order->id }}')">
                                            <ion-icon name="pencil-outline"></ion-icon>
                                        </button>
                                        <form action="" method="POST" style="display:inline;"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this order?')">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
                <h2>Pesanan</h2>
                <form>
                    <label for="name">Nama Pembeli :</label>
                    <input type="text" name="name" value="{{ $order->user->uname }}" readonly>
                    <label for="name">Nama Barang :</label>
                    <input type="text" name="name" value="{{ $order->product->name }}" readonly>
                    <label for="name">Waktu Memesan :</label>
                    <input type="text" name="name" value="{{ $order->created_at }}" readonly>
                    <label for="name">Status Pembayaran :</label>
                    <input type="text" name="name" value="{{ $order->payment_status }}" readonly>
                    <label for="name">Status Pesanan :</label>
                    <input type="text" name="name" value="{{ $order->order_status }}" readonly>
                </form>
            </div>
        </div>

        <!-- Modal for Updating Order -->
        <div class="modal" id="modal-update-{{ $order->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-update-{{ $order->id }}')">&times;</button>
                <h2>Update Pesanan</h2>
                <form action="" method="POST">
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
                        <option value="terkirim" {{ $order->order_status === 'terkirim' ? 'selected' : '' }}>Terkirim
                        </option>
                        <option value="dalam pengerjaan"
                            {{ $order->order_status === 'dalam pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan
                        </option>
                    </select>

                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    @endforeach


</body>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
