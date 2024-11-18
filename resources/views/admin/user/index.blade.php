<x-head></x-head>
<link rel="stylesheet" type="text/css" href="{{ url('css/admin.css') }}">

<body>

    <x-sidebaradmin></x-sidebaradmin>

    <div class="main">
        <x-topbaradmin></x-topbaradmin>
        @if (session('success'))
        @endif


        <div class="detail">
            <div class="cardHeader mt-5">
                <h2>Akun Pengguna</h2>
                <button class="link" onclick="openModal('modal-add')">Tambah Pengguna</button>
            </div>
            <div class="user" id="user">

                <table>
                    <thead>
                        <tr>
                            <th>Profil</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor</th>
                            <th>Kota</th>
                            <th>Peran</th>
                            <th class="aksi" colspan="3">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="list">
                                <td><img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
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
                                        <button class="aksi-button delete-user-button" type="button"
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
                @if ($users->hasPages())
                    <div class="pagination">
                        @if ($users->onFirstPage())
                            <span class="page-item disabled">Previous</span>
                        @else
                            <a class="page-item" href="{{ $users->previousPageUrl() }}">Previous</a>
                        @endif

                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <a class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}"
                                href="{{ $users->url($i) }}">{{ $i }}</a>
                        @endfor

                        @if ($users->hasMorePages())
                            <a class="page-item" href="{{ $users->nextPageUrl() }}">Next</a>
                        @else
                            <span class="page-item disabled">Next</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

    </div>

    <!-- Modal Tambah Pengguna -->
    <div class="modal" id="modal-add" style="display: none;">
        <div class="modal-content">
            <button class="close-btn" onclick="closeModal('modal-add')">&times;</button>
            <h2>Tambah Pengguna</h2>

            <form action="{{ route('admin.user.create') }}" method="POST" id="user-add"
                enctype="multipart/form-data">
                @csrf
                <!-- Tab Content -->
                <div class="input-row">
                    <div class="input-grup">
                        <label>Gambar Profil :</label>
                        <div class="image-profile edit-profile ml-3"
                            onclick="document.getElementById('image').click();">
                            <img class="img-preview" id="imgPreview" src="{{ asset('images/default-profile.jpg') }}">
                            <input type="file" id="image" name="image" class="image-preview"
                                onchange="userImageAdd()" style="display: none;">
                        </div>
                    </div>
                    <div class="input-grup">
                        <label for="uname">Nama :</label>
                        <input type="text" name="uname" required>

                        <label for="email">Email :</label>
                        <input type="email" name="email" required>
                    </div>
                </div>

                <div class="input-row mt-1">
                    <div class="input-grup">
                        <label for="password">Password :</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="input-grup">
                        <label for="phone">Telepon :</label>
                        <input type="text" name="phone" required>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-grup">
                        <label for="dob">Tanggal Lahir :</label>
                        <input type="date" name="dob" required>
                    </div>
                    <div class="input-grup">
                        <label for="city">Kota :</label>
                        <input type="text" name="city" required>
                    </div>
                </div>

                <label for="status">Status :</label>
                <select name="status" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

                <label for="bio">Bio :</label>
                <textarea name="bio"></textarea>

                <button type="submit" class="submit-btn">Kirim</button>
            </form>
        </div>
    </div>

    <!-- Modal Lihat Pengguna -->
    @foreach ($users as $user)
        <div class="modal" id="modal-view-{{ $user->id }}" style="display: none;">

            <div class="modal-content">

                <button class="close-btn" onclick="closeModal('modal-view-{{ $user->id }}')">&times;</button>

                <h2>Detail Pengguna</h2>

                <!-- Tab Content -->
                <div class="input-row">

                    <div class="input-grup">

                        <label>Gambar Profil :</label>

                        <div class="image-profile">

                            <img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
                                alt="Profil Pengguna">

                        </div>

                    </div>

                    <div class="input-grup">

                        <label>Nama :</label>

                        <input type="text" readonly value="{{ $user->uname }}">

                        <label>Email :</label>

                        <input type="email" readonly value="{{ $user->email }}">

                    </div>

                </div>

                <div class="input-row">

                    <div class="input-grup">

                        <label>Nomor Telepon :</label>

                        <input type="text" readonly value="{{ $user->phone }}">

                    </div>

                    <div class="input-grup">

                        <label>Kota :</label>

                        <input type="text" readonly value="{{ $user->city }}">

                    </div>

                </div>


                <label>Status :</label>

                <input type="text" readonly value="{{ $user->status }}">

                <label for="bio">Bio :</label>

                <textarea name="bio" readonly>{{ $user->bio }}</textarea>

            </div>

        </div>

        <!-- Modal Update Pengguna -->
        <div class="modal" id="modal-update-{{ $user->id }}" style="display: none;">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal('modal-update-{{ $user->id }}')">&times;</button>
                <h2>Perbarui Pengguna</h2>

                <!-- Tab Content -->
                <form action="{{ route('admin.user.update', $user->id) }}" id="user-update-{{ $user->id }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-row">
                        <div class="input-grup">
                            <label>Gambar Profil :</label>
                            <div class="image-profile edit-profile ml-3"
                                onclick="document.getElementById('image-{{ $user->id }}').click();">
                                <img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}"
                                    alt="Profil Pengguna" id="imgPreview-{{ $user->id }}" class="img-preview">
                            </div>
                            <input type="file" id="image-{{ $user->id }}" name="image"
                                class="image-preview" onchange="userImageUpdate('{{ $user->id }}')"
                                style="display: none;">
                        </div>
                        <div class="input-grup">
                            <label for="name">Nama :</label>
                            <input type="text" name="uname" value="{{ $user->uname }}" required>
                            <label for="email">Email :</label>
                            <input type="email" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>

                    <div class="input-row">
                        <div class="input-grup">
                            <label>Nomor Telepon :</label>
                            <input type="text" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="input-grup">
                            <label>Kota :</label>
                            <input type="text" name="city" value="{{ $user->city }}">
                        </div>
                    </div>


                    <label for="role">Status :</label>
                    <select name="status" required>
                        <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                    </select>

                    <label for="bio">Bio :</label>
                    <textarea name="bio">{{ $user->bio }}</textarea>

                    <button type="submit" class="submit-btn">Kirim</button>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            } else {
                console.error(`Modal with ID '${modalId}' not found.`);
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            } else {
                console.error(`Modal with ID '${modalId}' not found.`);
            }
        }
    </script>

    <x-script></x-script>

    <script src="{{ url('js/admins.js') }}"></script>
    <!------------------ ionicons ----------------------->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
