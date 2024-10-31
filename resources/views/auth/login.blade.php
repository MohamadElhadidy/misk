<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    @error('email')
        <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
    @enderror
    <form action="/login" method="post">
        @csrf
        <input type="email" name="email" placeholder="Enter Email Address">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="checkbox" name="remember" id="remember" > remember me
        <input type="submit" value="login">
    </form>
    {{ session('status') }}
    <a href="/register">Join Us</a>
    <a href="/forgot-password">forget Password?</a>
</body>

</html>
