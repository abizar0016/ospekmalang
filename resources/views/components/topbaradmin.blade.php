<div class="topbar">
    <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
    <div class="search-admin">
        <label class="label-admin">
            <input type="text" placeholder="Cari...">
            <ion-icon name="search-outline"></ion-icon>
        </label>
    </div>
    <div class="user-profil">
        @if (session('user_image'))
            <img src="{{ asset(session($user->image)) }}" alt="" style="max-width:50px; max-height:50px; border-radius:50%;">
        @else
            <img src="{{ url('images/admin.png') }}" alt="" style="max-width:50px; max-height:50px; border-radius:50%;">
        @endif
    </div>
</div>