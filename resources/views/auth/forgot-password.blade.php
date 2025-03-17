<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon" />

    <title>Forget Password</title>
    @vite('resources/css/app.css')

</head>

<body>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-24 w-auto" src="/assets/images/logo-black.png" alt="Misk Logo">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Forget Password</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        
        <form class="space-y-6" action="/forgot-password" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required
                           class="block w-full rounded-md  px-3 py-1.5 text-base  outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2  sm:text-sm/6

                            @error('email') bg-red-50  text-red-900 outline-red-500 focus:outline-[#ff240c]   @else focus:outline-[#E74A3A]  bg-white text-gray-900 @enderror
                            ">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                        {{ $message }}</p>
                    @enderror
                </div>
            </div>
           <span class="mt-2 text-green-600 text-sm"> {{ session('status') }}</span>

            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-[#E74A3A] px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#FF8000] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E74A3A]">Reset Password</button>
            </div>

        </form>
        <p class="mt-5 text-center text-sm/6 text-gray-500">
            <a href="{{ route('login') }}" class="font-semibold text-[#E74A3A] hover:text-[#FF8000]">Return to Login</a>
        </p>
    </div>
</div>
</body>

</html>
