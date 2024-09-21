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
            <h2>Produk</h2>
            <a href="{{ route('admin.product.create') }}"><button>Tambah Produk</button></a>
        </div>
        <div class="user" id="user">

            <table>
                <thead>
                    <tr>
                        <td>
                            Gambar
                        </td>
                        <td>
                            Nama
                        </td>
                        <td>
                            Deskripsi
                        </td>
                        <td>
                            Harga
                        </td>
                        <td>
                            Stok
                        </td>
                        <td>
                            Kategori
                        </td>
                        <td colspan="3">
                            aksi
                        </td>
                    </tr>
                </thead>

                <tbody>
                    @if ($products->isEmpty())
                        <tr>
                            <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Product yang Ditambahkan</td>
                        </tr>
                    @else
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset('images/' . $product->image1) }}" alt="Product Image 1" style="width: 50px; height: 50px;object-fit:contain">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->descriptions }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <a href="{{ route('admin.product.view', $product->id) }}"><button><ion-icon name="eye-outline"></ion-icon></button></a>
                                    <a href="{{ route('admin.product.update', $product->id) }}"><button><ion-icon name="pencil-outline"></ion-icon></button></a>
                                    <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display:inline;" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  onclick="return confirm('Are you sure you want to delete this product?')"><ion-icon name="trash-outline"></ion-icon></button>
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
