<x-head></x-head>
<x-sidebaradmin></x-sidebaradmin>

<div class="main">
    <x-topbaradmin></x-topbaradmin>
    <div class="profile-container">
        <div class="profile-header text-center">
            <img src="https://via.placeholder.com/150" alt="Profil Pengguna" class="profile-img">
            <h1 class="profile-name">Nama Pengguna</h1>
            <p class="profile-email">email@example.com</p>
        </div>
        <div class="profile-details">
            <form id="profileForm">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" value="Nama Pengguna">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" value="email@example.com">
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" class="form-control" placeholder="******">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

<script src="{{ url('js/admins.js') }}"></script>
<!-- ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
