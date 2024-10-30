<x-head></x-head>

<body>

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
                <button onclick="openModal('modal-add')">Tambah Produk</button>
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
                                <td colspan="6" style="padding-top: 30px; text-align:center;">Tidak Ada Product yang
                                    Ditambahkan</td>
                            </tr>
                        @else
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/' . $product->image1) }}" alt="Product Image 1"
                                            style="width: 50px; height: 50px;object-fit:contain">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->descriptions }}</td>
                                    <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->categories->name }}</td>
                                    <td>
                                        <button onclick="openModal('modal-view-{{ $product->id }}')"><ion-icon
                                                name="eye-outline"></ion-icon></button>
                                        <button onclick="openModal('modal-update-{{ $product->id }}')"><ion-icon
                                                name="pencil-outline"></ion-icon></button>
                                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST"
                                            style="display:inline;" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

            </div>
        </div>
    </div>

    <div class="modal" id="modal-add" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-add')">&times;</button>
            <h2>Tambah Produk</h2>

            <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <button class="tab-button active" onclick="openTab(event, 'Informasi')">Informasi</button>
                    <button class="tab-button" onclick="openTab(event, 'Images')">Gambar</button>
                    <button class="tab-button" onclick="openTab(event, 'PriceStock')">Harga & Stok</button>
                </div>

                <!-- Tab Content -->
                <div id="Informasi" class="tab-content active">
                    <div class="input-row">
                        <div class="input-grup">
                            <label for="name">Nama Produk:</label>
                            <input type="text" name="name" placeholder="Nama Produk" required>
                        </div>

                        <div class="input-grup">
                            <label for="category">Kategori:</label>
                            <select name="category_id" required>
                                @foreach ($categories as $categori)
                                    <option value="{{ $categori->id }}">{{ $categori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <label for="descriptions">Deskripsi:</label>
                    <textarea name="descriptions" placeholder="Masukan Deskripsi Produk" required></textarea>
                </div>

                <div id="Images" class="tab-content">
                    <div class="image-container">
                        <img id="imgPreview1" class="img-preview" src="">
                        <img id="imgPreview2" class="img-preview" src=""
                            onclick="setMainImage('{{ asset('images/' . $product->image2) }}')">
                        <img id="imgPreview3" class="img-preview" src=""
                            onclick="setMainImage('{{ asset('images/' . $product->image3) }}')">
                    </div>
                    <div class="input-row mt-4">
                        <div class="input-file">
                            <button type="button" class="custom-file-button"
                                onclick="document.getElementById('image1').click();">
                                Pilih Gambar 1
                            </button>
                            <input type="file" id="image1" name="image1" class="image-preview"
                                onchange="previewImage(1)" style="display: none;">
                        </div>

                        <div class="input-file">
                            <button type="button" class="custom-file-button"
                                onclick="document.getElementById('image2').click();">
                                Pilih Gambar 2
                            </button>
                            <input type="file" id="image2" name="image2" class="image-preview"
                                onchange="previewImage(2)" style="display: none;">
                        </div>

                        <div class="input-file">
                            <button type="button" class="custom-file-button"
                                onclick="document.getElementById('image3').click();">
                                Pilih Gambar 3
                            </button>
                            <input type="file" id="image3" name="image3" class="image-preview"
                                onchange="previewImage(3)" style="display: none;">
                        </div>
                    </div>
                </div>

                <!-- Button Tambah tetap di bagian bawah -->
                <div id="PriceStock" class="tab-content">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" placeholder="Masukan Harga Barang" required>

                    <label for="stock">Stok:</label>
                    <input type="number" name="stock" placeholder="Masukan Stok Barang" required>
                </div>

                <div class="button-container">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal for Viewing Product -->
    @foreach ($products as $product)
    <!-- Modal View -->
    <div class="modal" id="modal-view-{{ $product->id }}" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-view-{{ $product->id }}')">&times;</button>
            <h2>Detail Produk</h2>

            <!-- Tab Menu -->
            <div class="tab-menu">
                <button class="tab-button active" onclick="openTab(event, 'Informasi-{{ $product->id }}')">Informasi</button>
                <button class="tab-button" onclick="openTab(event, 'Images-{{ $product->id }}')">Gambar</button>
                <button class="tab-button" onclick="openTab(event, 'PriceStock-{{ $product->id }}')">Harga & Stok</button>
            </div>

            <!-- Tab Content -->
            <form>
                <div id="Informasi-{{ $product->id }}" class="tab-content active">
                    <div class="input-row">
                        <div class="input-grup">
                            <label for="name">Nama Produk:</label>
                            <input type="text" name="name" value="{{ $product->name }}" readonly>
                        </div>
                        <div class="input-grup">
                            <label for="category">Kategori:</label>
                            <input type="text" name="category" value="{{ $product->categories->name }}" readonly>
                        </div>
                    </div>
                    <label for="descriptions">Deskripsi:</label>
                    <textarea name="descriptions" readonly>{{ $product->descriptions }}</textarea>
                </div>

                <div id="Images-{{ $product->id }}" class="tab-content">
                    <div class="image-container">
                        <img class="img-preview" src="{{ asset('images/' . $product->image1) }}">
                        <img class="img-preview" src="{{ asset('images/' . $product->image2) }}"
                             onclick="setMainImage('{{ asset('images/' . $product->image2) }}')">
                        <img class="img-preview" src="{{ asset('images/' . $product->image3) }}"
                             onclick="setMainImage('{{ asset('images/' . $product->image3) }}')">
                    </div>
                </div>

                <div id="PriceStock-{{ $product->id }}" class="tab-content">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" value="{{ $product->price }}" required>
                    <label for="stock">Stok:</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal" id="modal-update-{{ $product->id }}" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-update-{{ $product->id }}')">&times;</button>
            <h2>Perbarui Produk</h2>

            <!-- Tab Menu -->
            <div class="tab-menu">
                <button class="tab-button active" onclick="openTab(event, 'UpdateInformasi-{{ $product->id }}')">Informasi</button>
                <button class="tab-button" onclick="openTab(event, 'UpdateImages-{{ $product->id }}')">Gambar</button>
                <button class="tab-button" onclick="openTab(event, 'UpdatePriceStock-{{ $product->id }}')">Harga & Stok</button>
            </div>

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tab Content -->
                <div id="UpdateInformasi-{{ $product->id }}" class="tab-content active">
                    <label for="name">Nama Produk:</label>
                    <input type="text" name="name" value="{{ $product->name }}" required>

                    <label for="category">Kategori:</label>
                    <select name="category_id" required>
                        @foreach ($categories as $categori)
                            <option value="{{ $categori->id }}" {{ $product->category_id == $categori->id ? 'selected' : '' }}>
                                {{ $categori->name }}
                            </option>
                        @endforeach
                    </select>

                    <label for="descriptions">Deskripsi:</label>
                    <textarea name="descriptions" required>{{ $product->descriptions }}</textarea>
                </div>

                <!-- Tab Gambar -->
                <div id="UpdateImages-{{ $product->id }}" class="tab-content">
                    <div class="image-container">
                        <img class="img-preview" src="{{ asset('images/' . $product->image1) }}">
                        <img class="img-preview" src="{{ asset('images/' . $product->image2) }}"
                             onclick="setMainImage('{{ asset('images/' . $product->image2) }}')">
                        <img class="img-preview" src="{{ asset('images/' . $product->image3) }}"
                             onclick="setMainImage('{{ asset('images/' . $product->image3) }}')">
                    </div>
                    <div class="input-row mt-4">
                        <button type="button" class="custom-file-button" onclick="document.getElementById('image1-{{ $product->id }}').click();">
                            Ganti Gambar 1
                        </button>
                        <input type="file" id="image1-{{ $product->id }}" name="image1" onchange="previewImage(1)" style="display: none;">

                        <button type="button" class="custom-file-button" onclick="document.getElementById('image2-{{ $product->id }}').click();">
                            Ganti Gambar 2
                        </button>
                        <input type="file" id="image2-{{ $product->id }}" name="image2" onchange="previewImage(2)" style="display: none;">

                        <button type="button" class="custom-file-button" onclick="document.getElementById('image3-{{ $product->id }}').click();">
                            Ganti Gambar 3
                        </button>
                        <input type="file" id="image3-{{ $product->id }}" name="image3" onchange="previewImage(3)" style="display: none;">
                    </div>
                </div>

                <!-- Tab Harga & Stok -->
                <div id="UpdatePriceStock-{{ $product->id }}" class="tab-content">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" value="{{ $product->price }}" required>

                    <label for="stock">Stok:</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required>
                </div>

                <!-- Button Update -->
                <div class="button-container">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endforeach



</body>

<x-script></x-script>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
