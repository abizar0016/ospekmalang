<x-head></x-head>
<link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}">

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
    <div class="cardHeader mt-5">
        <h2>Produk</h2>
        <button class="link" onclick="openModal('modal-add')">Tambah Produk</button>
    </div>

    <div class="user" id="user">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th class="aksi" colspan="3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isEmpty())
                    <tr>
                        <td colspan="7" style="padding-top: 30px; text-align:center;">Tidak Ada Produk yang Ditambahkan</td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $product->image1) }}" alt="Product Image 1" style="width: 50px; height: 50px; object-fit: contain;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->descriptions }}</td>
                            <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->categories->name }}</td>
                            <td>
                                <button class="aksi-button" onclick="openModal('modal-view-{{ $product->id }}')">Lihat</button>
                                <button class="aksi-button" onclick="openModal('modal-update-{{ $product->id }}')">Perbarui</button>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="aksi-button" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <!-- Custom Pagination -->
        @if ($products->hasPages())
            <div class="pagination">
                @if ($products->onFirstPage())
                    <span class="page-item disabled">Previous</span>
                @else
                    <a class="page-item" href="{{ $products->previousPageUrl() }}">Previous</a>
                @endif

                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <a class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}" href="{{ $products->url($i) }}">{{ $i }}</a>
                @endfor

                @if ($products->hasMorePages())
                    <a class="page-item" href="{{ $products->nextPageUrl() }}">Next</a>
                @else
                    <span class="page-item disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
</div>


    <div class="modal" id="modal-add" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-add')">&times;</button>
            <h2>Tambah Produk</h2>

            <div class="tab-menu">
                <button class="tab-button active" onclick="openTab(event, 'Informasi')">Informasi</button>
                <button class="tab-button" onclick="openTab(event, 'Images')">Gambar</button>
                <button class="tab-button" onclick="openTab(event, 'PriceStock')">Harga & Stok</button>
            </div>

            <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                        <img id="customImgPreview1" class="custom-img-preview" src="" alt="Image 1">
                        <img id="customImgPreview2" class="custom-img-preview" src="" alt="Image 2">
                        <img id="customImgPreview3" class="custom-img-preview" src="" alt="Image 3">
                    </div>
                    <div class="input-row mt-4">
                        <div class="input-file">
                            <button type="button" class="custom-file-button" onclick="$('#customImage1').click();">Pilih Gambar 1</button>
                            <input type="file" id="customImage1" name="image1" class="custom-image-input" onchange="productImage(1)" style="display: none;">
                        </div>
                        <div class="input-file">
                            <button type="button" class="custom-file-button" onclick="$('#customImage2').click();">Pilih Gambar 2</button>
                            <input type="file" id="customImage2" name="image2" class="custom-image-input" onchange="productImage(2)" style="display: none;">
                        </div>
                        <div class="input-file">
                            <button type="button" class="custom-file-button" onclick="$('#customImage3').click();">Pilih Gambar 3</button>
                            <input type="file" id="customImage3" name="image3" class="custom-image-input" onchange="productImage(3)" style="display: none;">
                        </div>
                    </div>
                </div>

                <div id="PriceStock" class="tab-content">
                    <label for="price">Harga:</label>
                    <input type="number" name="price" placeholder="Masukan Harga Barang" required>
                    <label for="stock">Stok:</label>
                    <input type="number" name="stock" placeholder="Masukan Stok Barang" required>
                </div>

                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </div>
    </div>

    @foreach ($products as $product)
        <!-- Modal View -->
        <div class="modal" id="modal-view-{{ $product->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-view-{{ $product->id }}')">&times;</button>
                <h2>Detail Produk</h2>

                <div class="tab-menu">
                    <button class="tab-button active" onclick="openTab(event, 'Informasi-{{ $product->id }}')">Informasi</button>
                    <button class="tab-button" onclick="openTab(event, 'Images-{{ $product->id }}')">Gambar</button>
                    <button class="tab-button" onclick="openTab(event, 'PriceStock-{{ $product->id }}')">Harga & Stok</button>
                </div>

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
                            <img src="{{ asset('images/' . $product->image1) }}">
                            <img src="{{ asset('images/' . $product->image2) }}" onclick="setMainImage('{{ asset('images/' . $product->image2) }}')">
                            <img src="{{ asset('images/' . $product->image3) }}" onclick="setMainImage('{{ asset('images/' . $product->image3) }}')">
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
        
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
        
                    <div class="tab-menu">
                        <button type="button" class="tab-button active" onclick="openTab(event, 'Informasi-{{ $product->id }}')">Informasi</button>
                        <button type="button" class="tab-button" onclick="openTab(event, 'Images-{{ $product->id }}')">Gambar</button>
                        <button type="button" class="tab-button" onclick="openTab(event, 'PriceStock-{{ $product->id }}')">Harga & Stok</button>
                    </div>
        
                    <div id="Informasi-{{ $product->id }}" class="tab-content active">
                        <div class="input-row">
                            <div class="input-grup">
                                <label for="name">Nama Produk:</label>
                                <input type="text" name="name" value="{{ $product->name }}" required>
                            </div>
                            <div class="input-grup">
                                <label for="category">Kategori:</label>
                                <select name="category_id" required>
                                    @foreach ($categories as $categori)
                                        <option value="{{ $categori->id }}" {{ $product->category_id == $categori->id ? 'selected' : '' }}>{{ $categori->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label for="descriptions">Deskripsi:</label>
                        <textarea name="descriptions" required>{{ $product->descriptions }}</textarea>
                    </div>
        
                    <div id="Images-{{ $product->id }}" class="tab-content">
                        <div class="image-container">
                            <img id="customImgPreviewUpdate1-{{ $product->id }}" class="custom-img-preview" src="{{ asset('images/' . $product->image1) }}" alt="Image 1">
                            <img id="customImgPreviewUpdate2-{{ $product->id }}" class="custom-img-preview" src="{{ asset('images/' . $product->image2) }}" alt="Image 2">
                            <img id="customImgPreviewUpdate3-{{ $product->id }}" class="custom-img-preview" src="{{ asset('images/' . $product->image3) }}" alt="Image 3">
                        </div>
                        <div class="input-row mt-4">
                            <div class="input-file">
                                <button type="button" class="custom-file-button" onclick="document.getElementById('customImageUpdate1-{{ $product->id }}').click();">Pilih Gambar 1</button>
                                <input type="file" id="customImageUpdate1-{{ $product->id }}" name="image1" class="custom-image-input" onchange="productImageUpdate(1, '{{ $product->id }}')" style="display: none;">
                            </div>
                            <div class="input-file">
                                <button type="button" class="custom-file-button" onclick="document.getElementById('customImageUpdate2-{{ $product->id }}').click();">Pilih Gambar 2</button>
                                <input type="file" id="customImageUpdate2-{{ $product->id }}" name="image2" class="custom-image-input" onchange="productImageUpdate(2, '{{ $product->id }}')" style="display: none;">
                            </div>
                            <div class="input-file">
                                <button type="button" class="custom-file-button" onclick="document.getElementById('customImageUpdate3-{{ $product->id }}').click();">Pilih Gambar 3</button>
                                <input type="file" id="customImageUpdate3-{{ $product->id }}" name="image3" class="custom-image-input" onchange="productImageUpdate(3, '{{ $product->id }}')" style="display: none;">
                            </div>
                        </div>
                    </div>
        
                    <div id="PriceStock-{{ $product->id }}" class="tab-content">
                        <label for="price">Harga:</label>
                        <input type="number" name="price" value="{{ $product->price }}" required>
                        <label for="stock">Stok:</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required>
                    </div>
        
                        <button type="submit" class="submit-btn">Kirim</button>
                </form>
            </div>
        </div>
        

    @endforeach
<script src="{{ url('js/admins.js') }}"></script>
<x-script></x-script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

