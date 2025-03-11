<!DOCTYPE html>
<html lang="en">

<head class="h-full bg-gray-100">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <title>{{$title ?? 'Admin'}} </title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="h-full">

    <div class="min-h-full">
        <nav class="bg-gray-800" x-data="{ open: false }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="size-8" src="/assets/images/logo.png" alt="Your Company">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <x-admin.nav-link href="/admin" :active="request()->is('admin')">Dashboard</x-admin.nav-link>
                                <x-admin.nav-link href="/admin/products" :active="str()->startsWith(request()->path(), 'admin/products')">Products
                                    Management</x-admin.nav-link>
                                <x-admin.nav-link href="/admin/categories" :active="str()->startsWith(request()->path(), 'admin/categories')">Categories
                                    Management</x-admin.nav-link>
                                <x-admin.nav-link href="/admin/orders" :active="str()->startsWith(request()->path(), 'admin/orders')">Orders
                                    Management</x-admin.nav-link>
                                <x-admin.nav-link href="/admin/customers" :active="str()->startsWith(request()->path(), 'admin/customers')">Customers
                                    List</x-admin.nav-link>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">

                            <!-- Profile dropdown -->
                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" type="button" id="user-menu-button"
                                            class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>

{{--                                        <img class="size-8 rounded-full"--}}
{{--                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"--}}
{{--                                             alt="">--}}

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" class="size-8 rounded-full" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                                    </button>
                                </div>

                                <div x-show="open" @click.away="open = false"
                                     class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5"
                                     x-transition>
                                    <a href="/admin/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                            Logout</button>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                        <button
                            @click="open = !open"
                            class="bg-gray-800 text-white p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div  class="md:hidden">
                <!-- Button to Toggle Mobile Menu -->


                <!-- Mobile Menu -->
                <div x-show="open" x-transition @click.outside="open = false" class="mt-2">
                    <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                        <x-admin.nav-link-mobile href="/admin" :active="request()->is('admin')">Dashboard</x-admin.nav-link-mobile>
                        <x-admin.nav-link-mobile href="/admin/products" :active="str()->startsWith(request()->path(), 'admin/products')">Products
                            Management</x-admin.nav-link-mobile>
                        <x-admin.nav-link-mobile href="/admin/categories" :active="str()->startsWith(request()->path(), 'admin/categories')">Categories
                            Management</x-admin.nav-link-mobile>
                        <x-admin.nav-link-mobile href="/admin/orders" :active="str()->startsWith(request()->path(), 'admin/orders')">Orders
                            Management</x-admin.nav-link-mobile>
                        <x-admin.nav-link-mobile href="/admin/customers" :active="str()->startsWith(request()->path(), 'admin/customers')">Customers
                            List</x-admin.nav-link-mobile>
                    </div>

                    <div class="border-t border-gray-700 pb-3 pt-0">

                        <div class="mt-2 space-y-1 px-2">
                            <x-admin.nav-link-mobile href="/admin/settings" :active="str()->startsWith(request()->path(), 'admin/settings')">Settings
                                </x-admin.nav-link-mobile>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                                    Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6  sm:px-6 lg:px-8 flex justify-between">
                {{ $header }}
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    @stack('scripts')
</body>

</html>
