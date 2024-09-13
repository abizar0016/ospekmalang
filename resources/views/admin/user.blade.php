<x-head></x-head>
<x-sidebaradmin></x-sidebaradmin>

@if (@session('success'))
@endif
<div class="main">
    <x-topbaradmin></x-topbaradmin>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="detail">
        <div class="user" id="user">
            <div class="cardHeader">
                <h2>Akun Pengguna</h2>
                <button onclick="openAddUserModal()">+</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>Profil</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Peran</td>
                        <td colspan="3">aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><img src="{{ asset($user->image) }}" alt="" width="50px" height="50px"
                                    style="border-radius: 50%; object-fit:cover;"></td>
                            <td class="name-tbl">{{ $user->uname }}</td>
                            <td class="email-tbl">{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <button onclick="openViewUserModal({{ $user->id }})"><ion-icon name="eye-outline"></ion-icon></button>
                                <button onclick="openEditUserModal({{ $user->id }})"><ion-icon name="pencil-outline"></ion-icon></button>
                                <form action="{{ route('user.delete', $user->id) }}" method="POST" style="display:inline;" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <ion-icon name="trash-outline"></ion-icon>
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

<!-- Modal untuk menambah pengguna -->
<div id="addUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeAddUserModal()">&times;</span>
        <h2>Tambah Pengguna</h2>
        <form action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image">Foto:</label>
            <img src="" class="img-preview" alt=""
                style="max-width:150px; max-height:150px;border-radius:50%;">
            <input type="file" id="image" name="image" onchange="previewImage()" required>

            <label for="uname">Nama:</label>
            <input type="text" id="uname" name="uname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="status">Peran:</label>
            <select id="status" name="status" required>
                <option value="admin" selected>Admin</option>
                <option value="user" selected>User</option>
            </select>

            <button type="submit">Kirim</button>
        </form>
    </div>
</div>

<!-- Modal untuk melihat pengguna -->
@if (isset($user))
    <div id="viewUserModal({{ $user->id }})" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeViewUserModal()">&times;</span>
            <h2>Detail Pengguna</h2>
            <form>
                @csrf
                <label for="image">Foto:</label>
                <img src="{{ asset($user->image) }}" class="img-preview" alt=""
                    style="width:150px; height:150px;border-radius:50%;object-fit:cover;">
                <label for="uname">Nama:</label>
                <input type="text" id="uname" name="uname" value="{{ $user->uname }}" readonly>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="{{ $user->password }}" readonly>

                <label for="status">Peran:</label>
                <input type="text" name="role" id="role" value="{{ $user->status }}" readonly>
            </form>
        </div>
    </div>
@endif

<!-- Modal untuk memperbarui pengguna -->
@if (isset($user))
    <div id="editUserModal({{ $user->id }})" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeEditUserModal()">&times;</span>
            <h2>Perbarui Pengguna</h2>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="image">Foto:</label>
                <img src="{{ asset($user->image) }}" class="img-preview" alt=""
                    style="width:150px; height:150px;border-radius:50%;object-fit:cover;">
                <input type="file" id="image" name="image" onchange="previewImage()">

                <label for="uname">Nama:</label>
                <input type="text" id="uname" name="uname" value="{{ $user->uname }}" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>

                <label for="password">Password:</label>
                <input type="password" id="password" value="{{ $user->password }}" name="password">

                <label for="status">Peran:</label>
                <select id="status" name="status" required>
                    <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->status == 'user' ? 'selected' : '' }}>User</option>
                </select>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>
@endif





<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
