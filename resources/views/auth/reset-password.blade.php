<h2>Reset Password</h2>
@if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif
<form method="POST" action="/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input name="email" type="email" placeholder="Your email"><br>
    <input name="password" type="password" placeholder="New password"><br>
    <input name="password_confirmation" type="password" placeholder="Confirm password"><br>
    <button type="submit">Reset Password</button>
</form>
