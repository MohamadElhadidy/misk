<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" type="image/x-icon" />

    <title>Login</title>
        @vite('resources/css/app.css')

</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-24 w-auto" src="/assets/images/logo-black.png" alt="Misk Logo">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
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

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required
                            class="block w-full rounded-md  px-3 py-1.5 text-base  outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2  sm:text-sm/6

                            @error('password') bg-red-50  text-red-900 outline-red-500 focus:outline-[#ff240c]   @else focus:outline-[#E74A3A]  bg-white text-gray-900 @enderror
                            ">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-between">
                    <div class="flex gap-3 ">
                        <div class="flex h-6 shrink-0 items-center">
                            <div class="group grid size-4 grid-cols-1">
                                <input id="rememberme" aria-describedby="rememberme-description" name="remember_me"
                                    type="checkbox"
                                    class=" hover:cursor-pointer col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-white checked:border-[#E74A3A] checked:bg-[#E74A3A] indeterminate:border-[#E74A3A] indeterminate:bg-[#E74A3A] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E74A3A] disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                    viewBox="0 0 14 14" fill="none">
                                    <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm/6">
                            <label for="rememberme" class="font-medium text-gray-900  hover:cursor-pointer">Remember
                                me</label>
                        </div>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}"
                            class="font-semibold text-[#E74A3A] hover:text-[#FF8000]">Forgot
                            password?</a>
                    </div>
                </div>



                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-[#E74A3A] px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#FF8000] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#E74A3A]">Sign
                        in</button>
                </div>

            </form>
            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Not a member?
                <a href="{{ route('register') }}" class="font-semibold text-[#E74A3A] hover:text-[#FF8000]">Create an
                    account</a>
            </p>
        </div>
    </div>
</body>

</html>
