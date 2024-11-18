<x-head></x-head>

<body>
    <style>
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .page-title {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-order {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-order th,
        .table-order td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            background-color: #717fe0;
            color: #fff;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 900px;
            width: 100%;
            position: relative;
            margin: 0 auto;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            padding: 0;
            list-style: none;
        }

        .product-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product-item strong {
            font-weight: bold;
        }
    </style>

    @include('components.userheader')

    <div style="margin-top: 100px">
        <h1 class="page-title">Daftar Pesanan</h1>

        <table class="table-order">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ $order->status }}</td>
                        <td style="display: flex; justify-content: center; gap: 10px;">
                            <button class="btn" onclick="openModal({{ $order->id }})">Lihat</button>
                            <button class="btn" onclick="openUpdateModal({{ $order->id }})">Perbarui</button>
                            <form id="order-delete-{{ $order->id }}" action="{{ route('user.order.delete', $order->id) }}" method="POST" class="delete-order">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal untuk melihat detail pesanan -->
                    <div class="modal" id="modal-{{ $order->id }}">
                        <div class="modal-content">
                            <button class="close-btn" onclick="closeModal({{ $order->id }})">&times;</button>
                            <h2>Detail Pesanan</h2>
                            <p><strong>Nama Pembeli:</strong> {{ $order->user ? $order->user->uname : 'Tidak Diketahui' }}</p>
                            <ul class="product-list">
                                @foreach ($orderItems->where('order_id', $order->id) as $item)
                                    <li class="product-item">
                                        <img src="{{ asset('images/' . $item->product->image1) }}" alt="{{ $item->product->name }}">
                                        <p><strong>Nama Produk:</strong> {{ $item->product->name }}</p>
                                        <p><strong>Jumlah:</strong> {{ $item->quantity }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Modal untuk memperbarui pesanan -->
                    <div class="modal" id="update-modal-{{ $order->id }}">
                        <div class="modal-content">
                            <button class="close-btn" onclick="closeUpdateModal({{ $order->id }})">&times;</button>
                            <h2>Perbarui Status Pesanan</h2>
                            <form action="{{ route('user.order.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <label for="status-{{ $order->id }}">Status:</label>
                                <select name="status" id="status-{{ $order->id }}" class="form-control">
                                    <option value="tertunda" {{ $order->status == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                                    <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="dikerjakan" {{ $order->status == 'dikerjakan' ? 'selected' : '' }}>Dikerjakan</option>
                                    <option value="dikembalikan" {{ $order->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                                <button type="submit" class="btn" style="margin-top: 10px;">Perbarui</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-script></x-script>
    <script>
        function openModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            if (modal) modal.style.display = 'flex';
        }

        function closeModal(id) {
            const modal = document.getElementById(`modal-${id}`);
            if (modal) modal.style.display = 'none';
        }

        function openUpdateModal(id) {
            const modal = document.getElementById(`update-modal-${id}`);
            if (modal) modal.style.display = 'flex';
        }

        function closeUpdateModal(id) {
            const modal = document.getElementById(`update-modal-${id}`);
            if (modal) modal.style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.style.display = 'none';
            });
        });
    </script>
</body>
