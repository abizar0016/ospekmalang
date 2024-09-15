<x-head></x-head>
<x-sidebaradmin></x-sidebaradmin>

<div class="main">
    <x-topbaradmin></x-topbaradmin>

    <h2>Detail Pengguna</h2>
    <div class="card">
        <div class="user-profile">
            <img class="user-image" src="{{ $user->image ? url($user->image) : asset('images/default-profile.jpg') }}" alt="{{ $user->uname }}">
            <h3 class="user-name">{{ $user->uname }}</h3>
        </div>
        <div class="detail-list">
            <p>Email: {{ $user->email }}</p>
            <p>Status: {{ $user->status }}</p>
            <p>Password: {{ $user->password }}</p>

        </div>
    </div>

</div>

<script src="{{ url('js/admins.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
