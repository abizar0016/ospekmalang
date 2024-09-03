<x-headform></x-headform>

<body>
    <div class="container">
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        <img src="{{ url('images/logo.png') }}" alt="">
        <div class="form-container">
            <div class="panel">
                <div class="panel-item">
                    <a href="{{ url('login') }}">
                        <button class="button-link active">Masuk</button>
                    </a>
                    <a href="{{ url('register') }}">
                        <button class="button-link">Daftar</button>
                    </a>
                </div>
            </div>



            <form action="{{ route('login') }}" method="POST" class="tbl-form">
                @csrf

                <h1 class="masuk">Masuk</h1>

                <label for="email">
                    <input type="email" name="email" id="email" class="input" required>
                    <span class="placeholder">Email</span>
                </label>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="password">
                    <input type="password" name="password" id="password" class="input" required>
                    <span class="placeholder">Password</span>
                </label>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <a href="" class="link">Lupa Kata Sandi?</a>

                <input type="submit" value="Masuk" class="action-btn">
            </form>
        </div>
    </div>

    <script src="{{ url('js/script.js') }}"></script>
</body>

</html>
