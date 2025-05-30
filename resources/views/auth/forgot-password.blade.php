<h2>Forgot Password</h2>
@if(session('status')) <p style="color:green;">{{ session('status') }}</p> @endif
@if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif
<form method="POST" action="/forgot-password">
    @csrf
    <input name="email" type="email" placeholder="Enter your email"><br>
    <button type="submit">Send Reset Link</button>
</form>
