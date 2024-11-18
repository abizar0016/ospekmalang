<x-head></x-head>
<link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}">

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
            <div class="cardHeader mt-5">
                <h2>Pesanan</h2>
            </div>
            <div class="user" id="user">
                <table>
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Total</th>
                        <th style="padding-right: 35rem">Status</th>
                        <th class="aksi" colspan="3">Aksi</th>
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
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
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
                        @endif
                    </tbody>
                </table>
                @if ($orders->hasPages())
                    <div class="pagination">
                        @if ($orders->onFirstPage())
                            <span class="page-item disabled">Previous</span>
                        @else
                            <a class="page-item" href="{{ $orders->previousPageUrl() }}">Previous</a>
                        @endif

                        @for ($i = 1; $i <= $orders->lastPage(); $i++)
                            <a class="page-item {{ $i == $orders->currentPage() ? 'active' : '' }}"
                                href="{{ $orders->url($i) }}">{{ $i }}</a>
                        @endfor

                        @if ($orders->hasMorePages())
                            <a class="page-item" href="{{ $orders->nextPageUrl() }}">Next</a>
                        @else
                            <span class="page-item disabled">Next</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    @foreach ($orderItems as $order)
        <!-- Modal for Viewing Order -->
        <div class="modal" id="modal-view-{{ $order->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-view-{{ $order->id }}')">&times;</button>
                <h2>Pesanan</h2>
                <form>
                    <label for="name">Nama Pembeli :</label>
                    <input type="text" name="name" value="{{ $order->user->uname }}" readonly>
                    
                    <label for="name">Barang yang Dibeli :</label>
                        @foreach ($orderItems as $item)
                                <input type="text" name="product" value="{{ $order->product->name }} - {{ $order->quantity }} pcs" readonly>
                        @endforeach
                    
                    <label for="name">Waktu Memesan :</label>
                    <input type="text" name="name"
                        value="{{ \Carbon\Carbon::parse($order->created_at)->locale('id')->translatedFormat('l, d F Y H:i') }}"
                        readonly>
                    <label for="name">Status Pesanan :</label>
                    <input type="text" name="name" value="{{ $order->order->status }}" readonly>
                </form>
            </div>
        </div>
        

        <!-- Modal for Updating Order -->
        <div class="modal" id="modal-update-{{ $order->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-update-{{ $order->id }}')">&times;</button>
                <h2>Update Pesanan</h2>
                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="order_status">Status Pesanan :</label>
                    <select name="status" required>
                        <option value="tertunda" {{ $order->status === 'tertunda' ? 'selected' : '' }}>Tertunda
                        </option>
                        <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dirkirim
                        </option>
                        <option value="dikerjakan" {{ $order->status === 'dikerjakan' ? 'selected' : '' }}>
                            Dikerjakan
                        </option>
                        <option value="dikembalikan" {{ $order->status === 'dikembalikan' ? 'selected' : '' }}>
                            Dikembalikan
                        </option>
                    </select>

                    <button type="submit" class="submit-btn">Kirim</button>
                </form>
            </div>
        </div>
    @endforeach

    <script>
         // Fungsi untuk membuka modal
         function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block'; // Menampilkan modal
                document.body.style.overflow = 'hidden'; // Mencegah scroll di background
            }
        }

        // Fungsi untuk menutup modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none'; // Menyembunyikan modal
                document.body.style.overflow = 'auto'; // Mengembalikan scroll di background
            }
        }
    </script>


</body>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
