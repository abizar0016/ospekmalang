<x-headform></x-headform>

<body>

    <div class="container">

        <img src="{{ url('images/logo.png') }}" alt="">

        <div class="form-container">

            <div class="panel">

                <div class="panel-item">

                    <a href="{{ url('login') }}">
                        <button class="button-link">Masuk</button>
                    </a>
                    <a href="{{ url('register') }}">
                        <button class="button-link active">Daftar</button>
                    </a>

                </div>

            </div>

            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="tbl-form">

                @csrf

                <h1 class="daftar">Daftar</h1>

                <label for="">
                    <input type="email" name="email" id="" class="input" required value="{{ old('email') }}">
                    <span class="placeholder">Email</span>
                </label>
                @error('email')
                    <div class="error" style="color: red">{{ $message }}</div>
                @enderror

                <label for="">
                    <input type="text" name="uname" id="" class="input" required value="{{ old('uname') }}">
                    <span class="placeholder">Nama</span>
                </label>
                @error('uname')
                    <div class="error" style="color: red">{{ $message }}</div>
                @enderror

                <label for="">
                    <input type="password" name="password" id="" class="input" required>
                    <span class="placeholder">Password</span>
                </label>
                @error('password')
                    <div class="error" style="color: red">{{ $message }}</div>
                @enderror

                <input type="submit" value="Daftar" class="action-btn">
            </form>

        </div>

    </div>

    <script src="{{ url('js/script.js') }}"></script>

</body>

</html>
