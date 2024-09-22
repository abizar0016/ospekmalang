<div class="topbar">
    <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
    <div class="user-profil">
        <a href="{{ route('user.index') }}">
            <button>
                Lihat Website
            </button>
        </a>
        @if (Auth::user()->image)
            <img src="{{ asset(Auth::user()->image) }}" alt="User Image" style="max-width:50px; max-height:50px; border-radius:50%;object-fit:cover">
        @else
            <img src="{{ url('images/default-profile.jpg') }}" alt="Default Image" style="max-width:50px; max-height:50px; border-radius:50%; object-fit:cover">
        @endif
    </div>
</div>