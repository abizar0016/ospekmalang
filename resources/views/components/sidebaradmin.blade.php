<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ url('admin') }}">
                    <span class="icon"><ion-icon name="logo-apple"></ion-icon></span>
                    <span class="tittle">Ospek Malang</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin') }}">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="tittle">Beranda</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/user') }}">
                    <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                    <span class="tittle">Pengguna</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/message') }}">
                    <span class="icon"><ion-icon name="chatbox-outline"></ion-icon></span>
                    <span class="tittle">Pesan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/help') }}">
                    <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                    <span class="tittle">Bantuan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/settings') }}">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="tittle">Pengaturan</span>
                </a>
            </li>
            
            <li>
                <a href="{{ url('admin/logout') }}">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="tittle">Keluar</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</div>