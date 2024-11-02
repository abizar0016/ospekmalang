<x-head></x-head>

<body>

    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>
        @if (session('success'))
        @endif


        <div class="detail">
            <div class="cardHeader mt-5">
                <h2>Akun Pengguna</h2>
                <button onclick="openModal('modal-add')">Tambah Pengguna</button>
            </div>
            <div class="user" id="user">

                <table>
                    <thead>
                        <tr>
                            <td>Profil</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <td>Nomor</td>
                            <td>Kota</td>
                            <td>Peran</td>
                            <td colspan="3">aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="list">
                                <td class="image-profile"><img
                                        src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
                                        alt="" width="50px" height="50px"
                                        style="border-radius: 50%; object-fit:cover;"></td>
                                <td class="name-tbl">{{ $user->uname }}</td>
                                <td class="email-tbl">{{ $user->email }}</td>
                                <td class="phone-tbl">{{ $user->phone }}</td>
                                <td class="city-tbl">{{ $user->city }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <button onclick="openModal('modal-view-{{ $user->id }}')" title="Lihat Pengguna"
                                        class="aksi-button">
                                        Lihat
                                    </button>
                                    <button onclick="openModal('modal-update-{{ $user->id }}')"
                                        title="Perbarui Pengguna" class="aksi-button">
                                        Perbarui
                                    </button>
                                    <form action="{{ route('admin.user.delete', $user->id) }}" method="POST"
                                        id="user-delete-{{ $user->id }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="aksi-button delete-button" type="button"
                                            data-form-id="user-delete-{{ $user->id }}"
                                            data-item-name="{{ $user->uname }}">
                                            Hapus
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal" id="modal-add" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-add')">&times;</button>
            <h2>Tambah Pengguna</h2>


            <!-- Tab Menu -->
            <div class="tab-menu">
                <button type="button" class="tab-button active"
                    onclick="openTab(event, 'Informasi')">Informasi</button>
                <button type="button" class="tab-button" onclick="openTab(event, 'Gambar')">Gambar Profil</button>
                <button type="button" class="tab-button" onclick="openTab(event, 'Status')">Info Lain</button>
            </div>

            <form action="{{ route('admin.user.create') }}" method="POST" id="user-add"
                enctype="multipart/form-data">
                @csrf
                <!-- Tab Content -->
                <div id="Informasi" class="tab-content active">
                    <label for="uname">Nama:</label>
                    <input type="text" name="uname" required>

                    <div class="input-row mt-1">
                        <div class="input-grup">
                            <label for="email">Email:</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="input-grup">
                            <label for="password">Password:</label>
                            <input type="password" name="password" required>
                        </div>
                    </div>

                    <label for="status">Status:</label>
                    <select name="status" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div id="Gambar" class="tab-content">
                    <label>Gambar Profil:</label>
                    <div class="image-profile">
                        <img class="img-preview" id="imgPreview"
                            style="display: none; width: 200px;height:200px; margin-bottom: 10px; border-radius:50%; object-fit:cover">
                    </div>
                    <div class="mt-3" style="text-align: center;">
                        <button type="button" class="custom-file-button"
                            onclick="document.getElementById('image').click();">
                            Pilih Gambar
                        </button>
                    </div>
                    <input type="file" id="image" name="image1" class="image-preview"
                        onchange="previewImageProfile()" style="display: none;">
                </div>

                <div id="Status" class="tab-content">

                    <label for="phone">Telepon:</label>
                    <input type="text" name="phone" required>

                    <label for="dob">Tanggal Lahir:</label>
                    <input type="date" name="dob" required>

                    <label for="city">Kota:</label>
                    <input type="text" name="city" required>

                    <label for="bio">Bio:</label>
                    <textarea name="bio" rows="3"></textarea>
                </div>

                <!-- Button Tambah tetap di bagian bawah -->
                <div class="button-container">
                    <button type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Modal Lihat Pengguna -->
    @foreach ($users as $user)
        <div class="modal" id="modal-view-{{ $user->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-view-{{ $user->id }}')">&times;</button>
                <h2>Detail Pengguna</h2>

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <button class="tab-button active"
                        onclick="openTab(event, 'Informasi-{{ $user->id }}')">Informasi</button>
                    <button class="tab-button" onclick="openTab(event, 'Images-{{ $user->id }}')">Gambar</button>
                </div>

                <!-- Tab Content -->
                <div id="Informasi-{{ $user->id }}" class="tab-content active">
                    <label>Nama:</label>
                    <input type="text" readonly value="{{ $user->uname }}">
                    <label>Email:</label>
                    <input type="email" readonly value="{{ $user->email }}">
                    <label>Nomor Telepon:</label>
                    <input type="text" readonly value="{{ $user->phone }}">
                    <label>Kota:</label>
                    <input type="text" readonly value="{{ $user->city }}">
                    <label>Status:</label>
                    <input type="text" readonly value="{{ $user->status }}">
                </div>

                <div id="Images-{{ $user->id }}" class="tab-content">
                    <label>Gambar Profil:</label>
                    <div class="image-profile" style="">
                        <img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
                            alt="Profil Pengguna"
                            style=" width: 200px; height:200px; margin-bottom: 10px; border-radius:50%;object-fit:cover">
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Update Pengguna -->
        <div class="modal" id="modal-update-{{ $user->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-update-{{ $user->id }}')">&times;</button>
                <h2>Perbarui Pengguna</h2>

                <!-- Tab Menu -->
                <div class="tab-menu">
                    <button class="tab-button active"
                        onclick="openTab(event, 'Informasi-{{ $user->id }}')">Informasi</button>
                    <button class="tab-button" onclick="openTab(event, 'Images-{{ $user->id }}')">Gambar</button>
                </div>

                <!-- Tab Content -->
                <div id="Informasi-{{ $user->id }}" class="tab-content active">
                    <form action="{{ route('admin.user.update', $user->id) }}" id="user-update-{{ $user->id }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="name">Nama:</label>
                        <input type="text" name="uname" value="{{ $user->uname }}" required>
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="{{ $user->email }}" required>
                        <label for="role">Role:</label>
                        <select name="status" required>
                            <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                </div>

                <div id="Images-{{ $user->id }}" class="tab-content">
                    <label>Gambar Profil:</label>
                    <div class="image-profile">
                        <img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
                            alt="Profil Pengguna" id="imgPreview-{{ $user->id }}" class="img-preview"
                            style="width:200px;height:200px;border-radius:50%; object-fit:cover;">
                    </div>
                    <div class="mt-3" style="text-align: center;">
                        <button type="button" class="custom-file-button"
                            onclick="document.getElementById('image-{{ $user->id }}').click();">
                            Pilih Gambar
                        </button>
                    </div>
                    <input type="file" id="image-{{ $user->id }}" name="image" class="image-preview"
                        onchange="previewImage({{ $user->id }})" style="display: none;">
                </div>

                <div class="button-container">
                    <button type="submit">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    @endforeach
</body>

<x-script></x-script>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
