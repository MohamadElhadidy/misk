<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Password</title>
</head>

<body>
    <form action="/reset-password" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ request('token') }}">
        <input type="hidden" name="email" value="{{ request('email') }}">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <input type="submit" value="Reset Password">
    </form>


    @error('email')
        {{ $message }}
    @enderror
</body>

</html>
