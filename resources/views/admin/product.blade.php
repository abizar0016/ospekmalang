<x-head></x-head>

<x-sidebaradmin></x-sidebaradmin>



<div class="main">
    <x-topbaradmin></x-topbaradmin>
    <div class="detail">
        <div class="user" id="user">
            <div class="cardHeader">
                <h2>Produk</h2>
                <button onclick="openAddProduct()">+</button>
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
                            <button onclick="openViewProduct()"><ion-icon name="eye-outline"></button>
                            <button onclick="openEditProduct()"><ion-icon name="pencil-outline"></ion-icon></button>
                            <button><ion-icon name="trash-outline"></ion-icon></button>
                        </td>
                    </tr>

                </tbody>
        </div>
    </div>

<!-- Modal untuk menambah produk -->
<div id="addProductModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeAddProduct()">&times;</span>
        <h2>Tambah Pengguna</h2>
        <form action="" method="POST">
            @csrf
            <label for="uname">Nama:</label>
            <input type="text" id="uname" name="uname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="status">Peran:</label>
            <select id="status" name="status" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <button type="submit">Kirim</button>
        </form>
    </div>
</div>

<!-- Modal untuk melihat produk -->
<!-- Modal untuk melihat produk -->
<div id="productViewModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeViewProduct()">&times;</span>
        <h2>Detail Pengguna</h2>
        <form>
            @csrf
            <label for="uname">Nama:</label>
            <input type="text" id="uname" name="uname" readonly>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" readonly>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" readonly>

            <label for="status">Peran:</label>
            <input type="text" name="role" id="role" readonly>
        </form>
    </div>
</div>

<!-- Modal untuk memperbarui produk -->
<div id="editProductModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeEditProduct()">&times;</span>
        <h2>Perbarui Pengguna</h2>
        <form action="" method="POST">
            @csrf
            <label for="uname">Nama:</label>
            <input type="text" id="uname" name="uname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="status">Peran:</label>
            <select id="status" name="status" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>

            <button type="submit">Kirim</button>
        </form>
    </div>
</div>

</div>



<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
