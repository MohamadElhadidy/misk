<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>

<body>
    <form action="/register" method="post">
        @csrf
        <input type="text" name="name" placeholder="Enter Name">
        <input type="email" name="email" placeholder="Enter Email Address">
        <input type="password" name="password" placeholder="Enter Password">
        <input type="submit" value="register">
    </form>
    <a href="/login">Sign In</a>
</body>

</html>
