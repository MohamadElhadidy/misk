<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
</head>

<body>
    <form action="/forgot-password" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Enter Email Address">
        <input type="submit" value="Reset Password">

    </form>
   {{ session('status') }}
    @error('email')
        {{ $message }}
    @enderror
    <a href="/login">Sign In</a>
    <a href="/register">Join Us</a>
</body>

</html>
