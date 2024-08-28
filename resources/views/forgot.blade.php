<!-- resources/views/auth/forgot-password.blade.php -->
<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <label for="email">Masukkan Email Anda:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Kirim Link Reset Sandi</button>
</form>
