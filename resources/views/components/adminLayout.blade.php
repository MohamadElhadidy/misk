<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class=" ml-4">
    <div>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/products">Products Management</a>
        <a href="/admin/categories">Categories Management</a>
    </div>

    <main class="mt-10">
        {{ $slot }}
    </main>
</body>

</html>
