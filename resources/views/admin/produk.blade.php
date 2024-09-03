<x-head></x-head>

<x-sidebaradmin></x-sidebaradmin>



<div class="main">
    <x-topbaradmin></x-topbaradmin>
    <div class="detail">
        <div class="user" id="user">
            <div class="cardHeader">
                <h2>Produk</h2>
                <button id="openModal">+</button>
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
                        <td colspan="3">
                            aksi
                        </td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Abizar</td>
                        <td>Scolos Probos Demos</td>
                        <td>Ini lah produk nya</td>
                        <td>Rp. 61.000</td>
                        <td>71</td>
                        <td>
                            <button>Balas</button>
                            <button>Perbarui</button>
                            <button>Hapus</button>
                        </td>
                    </tr>

                </tbody>
        </div>
    </div>
    <!-- Modal Popup -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Tambah Produk</h2>
            <form>
                <label for="productName">Nama Produk</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productDescription">Deskripsi</label>
                <textarea id="productDescription" name="productDescription" required></textarea>

                <label for="productPrice">Harga</label>
                <input type="text" id="productPrice" name="productPrice" required>

                <label for="productStock">Stok</label>
                <input type="number" id="productStock" name="productStock" required>

                <label for="productImage">Gambar Produk</label>
                <input type="file" id="productImage" name="productImage" accept="image/*" required>

                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</div>



<script src="{{ url('js/admin.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
