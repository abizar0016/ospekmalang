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
                        <td>
                            Nama Pembeli
                        </td>
                        <td>
                            Nama Barang
                        </td>
                        <td>
                            Waktu Order
                        </td>
                        <td>
                            Status Pembayaran
                        </td>
                        <td>
                            Status Pengiriman
                        </td>
                        <td colspan="3">
                            aksi
                        </td>
                    </tr>
                </thead>

                <tbody>
                    @if ($orders->isEmpty())
                        <tr>
                            <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Orderan Sekarang</td>
                        </tr>
                    @else
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->user_id->uname }}</td>
                                <td>{{ $order->product_id->name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>Rp. {{ $order->payment_status }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>
                                    <a href="{{ route('admin.order.view', $order->id) }}"><button><ion-icon name="eye-outline"></ion-icon></button></a>
                                    <a href="{{ route('admin.order.update', $order->id) }}"><button><ion-icon name="pencil-outline"></ion-icon></button></a>
                                    <form action="{{ route('admin.order.delete', $order->id) }}" method="POST" style="display:inline;" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  onclick="return confirm('Are you sure you want to delete this order?')"><ion-icon name="trash-outline"></ion-icon></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                
        </div>
    </div>
</div>

</body>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
