<x-head></x-head>
<x-sidebaradmin></x-sidebaradmin>

<div class="main">
    <x-topbaradmin></x-topbaradmin>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="detail">
        <div class="cardHeader">
            <h2>Akun Pengguna</h2>
            <a href="{{ route('admin.user.create') }}"><button>Tambah Akun</button></a>
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
                            <td class="image-profile"><img src="{{ $user->image ? asset($user->image) : asset('images/default-profile.jpg') }}" alt="" width="50px" height="50px"
                                    style="border-radius: 50%; object-fit:contain;"></td>
                            <td class="name-tbl">{{ $user->uname }}</td>
                            <td class="email-tbl">{{ $user->email }}</td>
                            <td class="phone-tbl">{{ $user->phone }}</td>
                            <td class="city-tbl">{{ $user->city }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <a href="{{ route('admin.user.view', $user->id) }}"><button><ion-icon name="eye-outline"></ion-icon></button></a>
                                <a href="{{ route('admin.user.update', $user->id) }}"><button><ion-icon name="pencil-outline"></ion-icon></button></a>
                                <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" style="display:inline;" enctype="multipart/form-data">
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

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>