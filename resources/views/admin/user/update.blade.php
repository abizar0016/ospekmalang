<x-head></x-head>

<body>
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
                <div class="cardHeader">
                    <h2>Perbarui Akun</h2>
                </div>
                <div class="card-view">
                    <div class="detail-list">
                        <label for="image">Gambar Profil :</label>
                        <div class="input-singgle">
                            @if ($user->image)
                                <img id="img-preview" src="{{ asset($user->image) }}" class="img-preview user-image"
                                    style="width: 100px; height: 100px;">
                            @else
                                <img id="img-preview" src="{{ url('images/default-profile.jpg') }}"
                                    class="img-preview user-image" style="width: 100px; height: 100px;">
                            @endif
                        </div>
                        <div class="input-singgle">
                            <input type="file" id="image" name="image" class="text-disabled image-preview"
                                onchange="previewImageProfile()">
                        </div>

                        <div class="input-singgle">
                            <label for="uname">Nama :</label>
                            <input required type="text" name="uname" value="{{ $user->uname }}"
                                class="text-disabled">
                        </div>
                        <div class="input-group">
                            <div class="input-group-item">
                                <label for="email">Email :</label>
                                <input required type="email" name="email" value="{{ $user->email }}"
                                    class="text-disabled">
                            </div>
                            <div class="input-group-item">
                                <label for="phone">Nomor Ponsel :</label>
                                <input required type="number" name="phone" value="{{ $user->phone }}"
                                    class="text-disabled">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-group-item">
                                <label for="dob">Tanggal Lahir :</label>
                                <input required type="date" name="dob" value="{{ $user->dob }}"
                                    class="text-disabled">
                            </div>
                            <div class="input-group-item">
                                <label for="city">Kota :</label>
                                <input required type="text" name="city" value="{{ $user->city }}"
                                    class="text-disabled">
                            </div>
                        </div>
                        <div class="input-singgle">
                            <label for="bio">Bio :</label>
                            <textarea name="bio" class="text-area-disabled">{{ $user->bio }}</textarea>
                        </div>
                        <div class="input-singgle">
                            <label for="status">Peran :</label>
                            <select name="status" required class="text-disabled">
                                <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="button-group">
                    <a href="{{ route('admin.user') }}" class="btn back-btn">Kembali</a>
                    <input type="submit" value="Kirim" class="btn update-btn">
                </div>
            </form>
        </div>
    </div>
</body>
<script src="{{ url('js/admins.js') }}"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
