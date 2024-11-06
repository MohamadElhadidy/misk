@props(['title'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Misk | {{ $title ?? 'The Art of Timeless Scents' }} </title>
    <link rel="shortcut icon" href="/assets/images/fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/dist/output-scss.css" />
    <link rel="stylesheet" href="/dist/output-tailwind.css" />
</head>

<body>
    <x-top-nav />
    <x-header />
    {{ $slot }}
    <x-footer />
    <x-modals />

    <script src="/assets/js/phosphor-icons.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/main.js"></script>
</body>

</html>
