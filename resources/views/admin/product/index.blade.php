<x-head></x-head>

<x-sidebaradmin></x-sidebaradmin>



<div class="main">
    <x-topbaradmin></x-topbaradmin>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="detail">
        <div class="user" id="user">
            <div class="cardHeader">
                <h2>Produk</h2>
                <a href="{{ route('admin.product.create') }}"><button>Tambah Produk</button></a>
            </div>

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
                            <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Product yang
                                Ditambahkan</td>
                        </tr>
                    @else
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="{{ url($product->image) }}" alt="Product Image" style="width: 50px; height: 50px;"></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->deskripsi }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->category }}</td>
                                <td>
                                    <button onclick="openViewProduct({{ $product->id }})"><ion-icon
                                            name="eye-outline"></ion-icon></button>
                                    <button onclick="openEditProduct({{ $product->id }})"><ion-icon
                                            name="pencil-outline"></ion-icon></button>
                                    <form action="" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><ion-icon name="trash-outline"></ion-icon></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
        </div>
    </div>

    <!-- Modal untuk menambah produk -->
    <div id="addProductModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeAddProduct()">&times;</span>
            <h2>Tambah Produk</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="deskripsi">Deskripsi:</label>
                <input type="text" id="deskripsi" name="deskripsi" required>

                <label for="image">Gambar:</label>
                <input type="file" name="image" id="image" required>

                <label for="stock">Stok:</label>
                <input type="number" id="stock" name="stock" required>

                <label for="price">Harga:</label>
                <input type="text" id="price" name="price" required>

                <label for="category">Kategori:</label>
                <select name="category" id="category">
                    <option value="Baju">Baju</option>
                    <option value="Celana">Celana</option>
                    <option value="Sepatu">Sepatu</option>
                    <option value="Aksesoris">Aksesoris</option>
                </select>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>


    <!-- Modal untuk melihat produk -->
    @if (@isset($product))
    
    <div id="productViewModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeViewProduct()">&times;</span>
            <h2>Detail Pengguna</h2>
            <form action="">

                <label for="uname">Nama:</label>
                <input type="text" id="uname" name="uname" value="{{ $product->name }}" readonly>

                <label for="email">Deskripsi:</label>
                <input type="text" id="descriptions" name="descriptions" value="{{ $product->deskripsi }}" readonly>

                <label for="">Gambar:</label>
                <img src="{{ url($product->image) }}" alt=""
                    style="width: 200px; border:1px solid #000; height:220px">

                <label for="password">stok:</label>
                <input type="number" id="stock" name="stock" value="{{ $product->stock }}" readonly>

                <label for="">Harga:</label>
                <input type="number" id="productPrice" name="price" value="{{ $product->price }}" readonly>

                <label for="category">Kategori:</label>
                <input type="text" name="category" id="category" value="{{ $product->category }}">


            </form>
        </div>
    </div>
    
    <!-- Modal untuk memperbarui produk -->
    <di v id="editProductModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeEditProduct()">&times;</span>
            <h2>Perbarui Pengguna</h2>
            <form action="" method="POST">
                @csrf

                <label for="uname">Nama:</label>
                <input type="text" id="uname" name="uname"  value="{{ $product->name }}" required>

                <label for="email">Deskripsi:</label>
                <input type="text" id="descriptions" name="descriptions" value="{{ $product->deskripsi }}" required>

                <label for="">Gambar:</label>
                <img src="{{ url($product->image) }}" alt=""
                    style="width: 200px; border:1px solid #000; height:220px">
                <input type="file" name="image" id="image" required>

                <label for="password">stok:</label>
                <input type="number" id="stock" value="{{ $product->stock }}" name="stock" required>

                <label for="">Harga:</label>
                <input type="number" id="productPrice" name="price"  value="{{ $product->price }}"required>

                <label for="category">Kategori:</label>
                <select name="category" id="category" value="{{ $product->category }}" required>
                    <option value="Baju">Baju</option>
                    <option value="Celana">Celana</option>
                    <option value="Sepatu">Sepatu</option>
                    <option value="Aksesoris">Aksesoris</option>
                </select>


                <button type="submit">Kirim</button>
            </form>
        </div>
    </di>
    @endif

</div>



<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
