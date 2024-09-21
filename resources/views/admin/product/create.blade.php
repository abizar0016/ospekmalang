<x-head></x-head>

<body class="animation">

<x-sidebaradmin></x-sidebaradmin>

<div class="main">
    <x-topbaradmin></x-topbaradmin>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="detail">
        <form action="{{ route('admin.product.create.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-product">
                <div class="cardHeader">
                    <h2>Tambahkan Produk</h2>
                </div>
                <div class="detail-list">
                    <div class="image-product-grup">
                        <div class="input-grup">
                            <label for="image1">Gambar Produk 1:</label>
                            <img id="imgPreview1" class="img-preview" style="width: 100px; height: 100px; object-fit:contain;" src="#">
                            <input required type="file" id="image1" name="image1" class="image-preview text-disabled"
                                onchange="previewImage(1)">
                        </div>
    
                        <div class="input-grup">
                            <label for="image2">Gambar Produk 2:</label>
                            <img id="imgPreview2" class="img-preview" style="width: 100px; height: 100px; object-fit:contain;" src="#">
                            <input type="file" id="image2" name="image2" class="image-preview text-disabled"
                                onchange="previewImage(2)">
                        </div>
    
                        <div class="input-grup">
                            <label for="image3">Gambar Produk 3:</label>
                            <img id="imgPreview3" class="img-preview" style="width: 100px; height: 100px; object-fit:contain;" src="#">
                            <input type="file" id="image3" name="image3" class="image-preview text-disabled"
                                onchange="previewImage(3)">
                        </div>
                    </div>

                    <div class="input-singgle">
                        <label for="name">Nama:</label>
                        <input required type="text" name="name" class="text-disabled">
                    </div>

                    <div class="input-singgle">
                        <label for="description">Deskripsi:</label>
                        <textarea required name="descriptions" class="text-disabled" style="resize: none"></textarea>
                    </div>

                    <div class="input-group">
                        <div class="input-group-item">
                            <label for="price">Harga:</label>
                            <input required type="number" name="price" class="text-disabled">
                        </div>
                        <div class="input-group-item">
                            <label for="stock">Stok:</label>
                            <input required type="number" name="stock" class="text-disabled">
                        </div>
                    </div>

                    <div class="input-singgle">
                        <label for="category">Kategori:</label>
                        <select name="category_id" required class="text-disabled">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.product.index') }}" class="btn">Kembali</a>
                <input type="submit" value="Kirim" class="btn">
            </div>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

</body>

<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
