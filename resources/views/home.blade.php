<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Misk</title>
</head>

<body>
    Welcome
    @auth
        <a href="/profile">Profile</a>
        <form method="POST" action="/logout">
            @csrf
            <input type="submit" value="Logout" />
        </form>
    @else
        <a href="/login">Login</a>
    @endauth

</body>

</html>
