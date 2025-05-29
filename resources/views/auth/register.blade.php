<h2>Register</h2>
@if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif
<form method="POST" action="/register">
    @csrf
    <input name="name" type="text" placeholder="Full Name"><br>
    <input name="email" type="email" placeholder="Email"><br>
    <input name="password" type="password" placeholder="Password"><br>
    <input name="password_confirmation" type="password" placeholder="Confirm Password"><br>
    <button type="submit">Register</button>
</form>
