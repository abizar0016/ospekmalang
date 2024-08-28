<x-head></x-head>

<x-sidebaradmin></x-sidebaradmin>

{{-- content --}}

<div class="main">
    <div class="topbar">
        <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
        <div class="search-admin">
            <label class="label-admin">
                <input type="text" placeholder="Cari...">
                <ion-icon name="search-outline"></ion-icon>
            </label>
        </div>
        <div class="user">
            <img src="" alt="">
        </div>
    </div>

</div>

{{-- script --}}
<script src="{{ url('js/admin.js') }}"></script>
<!------------------ ionicons ----------------------->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>