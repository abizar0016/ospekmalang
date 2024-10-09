<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ url('admin') }}">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
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
                <a href="{{ url('admin/product') }}">
                    <span class="icon"><ion-icon name="cube-outline"></ion-icon></span>
                    <span class="tittle">Produk</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/order') }}">
                    <span class="icon"><ion-icon name="cart-outline"></ion-icon></span>
                    <span class="tittle">Pesanan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('admin/categories') }}">
                    <span class="icon"><ion-icon name="apps-outline"></ion-icon></span>
                    <span class="tittle">Kategori</span>
                </a>
            </li>
            
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="tittle">Keluar</span>
                </a>
            </li>
            

        </ul>
    </div>

</div>