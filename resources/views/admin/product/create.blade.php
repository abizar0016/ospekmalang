<x-head></x-head>
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
                    <div class="form-grup">
                        <label for="image">Gambar Produk :</label>
                        <img class="img-preview" style="">
                    </div>
                    <div class="form-row">
                        <input required type="file" id="image" name="image" class="text-disabled image-preview"
                            onchange="previewImage()">
                    </div>

                    <div class="form-row">
                        <label for="name">Nama :</label>
                        <input required type="text" name="name" class="text-disabled">
                    </div>
                    <div class="form-row">
                        <label for="description">Deskripsi: </label>
                        <textarea required name="descriptions" class="text-disabled" style="resize: none"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Harga :</label>
                            <input required type="number" name="price" class="text-disabled">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok :</label>
                            <input required type="number" name="stock" class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="category">Kategori :</label>
                        <select name="category" required class="text-disabled">
                            <option value="user">Baju</option>
                            <option value="celana">Celana</option>
                            <option value="sepatu">Sepatu</option>
                            <option value="aksesoris">Aksesoris</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <input type="submit" value="Tambah" class="btn"></input>
                <a href="{{ route('admin.product.index') }}" class="btn">Kembali</a>
            </div>
        </form>
    </div>
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

<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
