<x-adminLayout>
    <x-slot:title>
        Shipping Settings
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Settings</x-admin.heading>
    </x-slot>
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar-settings/>

        <!-- Content -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Shipping Settings</h2>

                <form method="POST"  action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>


                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="shipping_fee" class="block text-sm/6 font-medium text-gray-900">Shipping Fee</label>
                                    <div class="mt-2">
                                        <input type="text" name="shipping_fee" id="shipping_fee" autocomplete="shipping_fee"
                                               value="{{ old('shipping_fee', $settings->get('shipping_fee'))}}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                        </div>

                </form>

            </div>


        </main>
    </div>
</x-adminLayout>
