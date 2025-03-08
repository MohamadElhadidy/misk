<x-adminLayout>
    <x-slot:title>
        Settings
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Settings</x-admin.heading>
    </x-slot>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar-settings/>

        <!-- Content -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Store Information</h2>

                <form method="POST"  action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf





                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>


                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="store_name" class="block text-sm/6 font-medium text-gray-900">Store Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_name" id="store_name" autocomplete="store_name"
                                               value="{{ old('store_name', $settings['store_name']) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="store_email" class="block text-sm/6 font-medium text-gray-900">Store Email</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_email" id="store_email" autocomplete="store_email"
                                               value="{{ old('store_email', $settings['store_email']) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="store_phone" class="block text-sm/6 font-medium text-gray-900">Store Phone</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_phone" id="store_phone" autocomplete="store_phone"
                                               value="{{ old('store_phone', $settings['store_phone']) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="store_address" class="block text-sm/6 font-medium text-gray-900">Store Address</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_address" id="store_address" autocomplete="store_address"
                                               value="{{ old('store_address', $settings['store_address']) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                            </div>


{{--                            store_logo --}}
{{--                            favicon --}}
{{--                            banner_1 --}}
{{--                            banner_2 --}}
{{--                            banner_3 --}}

                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
{{--                            <a href="/admin/products" class="text-sm/6 font-semibold text-gray-900">Cancel</a>--}}
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                        </div>

                </form>

            </div>


        </main>
    </div>
</x-adminLayout>
