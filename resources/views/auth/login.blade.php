<h2>Login</h2>
@if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif
<form method="POST" action="/login">
    @csrf
    <input name="email" type="email" placeholder="Email"><br>
    <input name="password" type="password" placeholder="Password"><br>
    <button type="submit">Login</button>
</form>
<a href="/forgot-password">Forgot password?</a>
