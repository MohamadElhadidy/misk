@props(['title'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Misk | {{ $title ?? 'The Art of Timeless Scents' }} </title>
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon" />

    <link
        href="https://fonts.googleapis.com/css2?family=Aoboshi+One&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/fonts/flaticon/flaticon_pesco.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/vendor/slick/slick.css">
    <link rel="stylesheet" href="/assets/vendor/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="/assets/vendor/magnific-popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="/assets/vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/vendor/aos/aos.css">
    <link rel="stylesheet" href="/assets/css/default.css">
    <link rel="stylesheet" href="/assets/css/style.css">




    @vite('resources/css/app.css')

</head>

<body>
    <div class="preloader">
        <div class="loader">
            <img src="/assets/images/loader.gif" alt="Loader">
        </div>
    </div>

    <div class="offcanvas__overlay"></div>

    {{-- <x-top-nav /> --}}
    <x-header />
    {{ $slot }}
    <x-footer />
    <x-modals />

    <div class="back-to-top"><i class="far fa-angle-up"></i></div>


    <script src="/assets/vendor/jquery-3.7.1.min.js"></script>
    <script src="/assets/vendor/popper/popper.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/vendor/slick/slick.min.js"></script>
    <script src="/assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="/assets/vendor/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/vendor/simplyCountdown.min.js"></script>
    <script src="/assets/vendor/aos/aos.js"></script>
    <script src="/assets/js/theme.js"></script>

</body>

</html>
