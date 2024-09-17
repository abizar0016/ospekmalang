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
        <form action="{{ route('admin.user.update.post', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-view">
                <div class="cardHeader">
                    <h2>Perbarui Akun</h2>
                </div>
                <div class="detail-list">
                    <label for="image">Gambar Profil :</label>
                    <div class="form-row">
                        @if ($user->image)
                            <img id="current-image" src="{{ asset($user->image) }}" class="img-preview user-image">
                        @endif
                    </div>
                    <div class="form-row">
                        <input required type="file" id="image" name="image" class="text-disabled image-preview"
                            onchange="previewImage()">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="uname">Nama :</label>
                            <input required type="text" name="uname" value="{{ $user->uname }}"
                                class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input required type="email" name="email" value="{{ $user->email }}"
                                class="text-disabled">
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Ponsel :</label>
                            <input required type="number" name="phone" value="{{ $user->phone }}"
                                class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dob">Tanggal Lahir :</label>
                            <input required type="date" name="dob" value="{{ $user->dob }}"
                                class="text-disabled">
                        </div>
                        <div class="form-group">
                            <label for="city">Kota :</label>
                            <input required type="text" name="city" value="{{ $user->city }}"
                                class="text-disabled">
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="bio">Bio :</label>
                        <textarea name="bio" class="text-area-disabled">{{ $user->bio }}</textarea>
                    </div>
                    <div class="form-row">
                        <label for="status">Peran :</label>
                        <select name="status" required class="text-disabled">
                            <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="button-group">
                <input type="submit" value="Perbarui" class="btn update-btn">
                <a href="{{ route('admin.user') }}" class="btn back-btn">Kembali</a>
            </div>
        </form>
    </div>
</div>

<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
