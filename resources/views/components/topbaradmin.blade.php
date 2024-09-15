<div class="topbar">
    <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
    <div class="search-admin">
        <label class="label-admin">
            <input type="text" placeholder="Cari...">
            <ion-icon name="search-outline"></ion-icon>
        </label>
    </div>
    <div class="user-profil">
        @if (Auth::user()->image)
            <img src="{{ asset(Auth::user()->image) }}" alt="User Image" style="max-width:50px; max-height:50px; border-radius:50%;">
        @else
            <img src="{{ url('images/admin.png') }}" alt="Default Image" style="max-width:50px; max-height:50px; border-radius:50%;">
        @endif
    </div>
</div>