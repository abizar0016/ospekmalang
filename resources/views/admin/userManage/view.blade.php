<x-head></x-head>
<x-sidebaradmin></x-sidebaradmin>

<div class="main">
    <x-topbaradmin></x-topbaradmin>

    <div class="detail">
        <div class="card-view">
            
                    <div class="cardHeader">
                        <h2>Informasi Akun</h2>
                    </div>
            <div class="user-profile">
                <img class="user-image" src="{{ $user->image ? url($user->image) : asset('images/default-profile.jpg') }}"
                    alt="{{ $user->uname }}">
            </div>
            <div class="detail-list">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">Nama:</label>
                        <div class="text-disabled">{{ $user->uname }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="text-disabled">{{ $user->email }}</div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Ponsel</label>
                        <div class="text-disabled">{{ $user->phone }}</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="dob">Tanggal Lahir</label>
                        <div class="text-disabled">{{ $user->dob }}</div>
                    </div>
                    <div class="form-group">
                        <label for="city">Kota</label>
                        <div class="text-disabled">{{ $user->city }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <div class="text-area-disabled">{{ $user->bio }}</div>
                </div>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ route('admin.user') }}" class="btn back-btn">Kembali</a>
            <a href="{{ route('admin.user.update', $user->id) }}" class="btn update-btn">Perbarui</a>
            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="delete-form"
                onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn delete-btn">Hapus</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
