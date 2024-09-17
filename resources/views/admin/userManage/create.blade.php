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

        <form action="{{ route('admin.user.create.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-view">
                <div class="cardHeader">
                    <h2>Tambah Akun</h2>
                </div>
                <div class="detail-list">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="uname">Nama :</label>
                            <input required type="text" name="uname" class="text-disabled">
                            <label for="password">Password :</label>
                            <input required type="password" name="password" class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input required type="email" name="email" class="text-disabled">
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Ponsel :</label>
                            <input required type="number" name="phone" class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Tanggal Lahir :</label>
                            <input required type="date" name="dob" class="text-disabled">
                        </div>
                        <div class="form-group">
                            <label for="city">Kota :</label>
                            <input required type="text" name="city" class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="bio">Bio :</label>
                        <textarea name="bio" class="text-area-disabled"></textarea>
                    </div>
                    <div class="form-row">
                        <label for="image">Gambar Profil :</label>
                        <img class="img-preview" style="display: none; max-width: 200px; margin-bottom: 10px;">
                        <input required type="file" id="image" name="image" class="text-disabled image-preview" onchange="previewImage()">
                    </div>
                    <div class="form-row">
                        <label for="status">Peran :</label>
                        <select name="status" required class="text-disabled">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="button-group">
                <input type="submit" value="Tambah" class="btn"></input>
                <a href="{{ route('admin.user') }}" class="btn">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
