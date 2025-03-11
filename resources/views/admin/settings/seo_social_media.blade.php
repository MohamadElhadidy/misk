<x-adminLayout>
    <x-slot:title>
        SEO & Social Media
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
                <h2 class="text-xl font-semibold mb-4">SEO & Social Media</h2>

                <form method="POST"  action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="store_title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_title" id="store_title" autocomplete="store_title"
                                               value="{{ old('store_title', $settings->get('store_title'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="meta_description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                                    <div class="mt-2">
                                        <input type="text" name="meta_description" id="meta_description" autocomplete="meta_description"
                                               value="{{ old('meta_description', $settings->get('meta_description'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>

                            </div>

                            <div class="border-b border-gray-900/10 my-8"></div>

                            <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="social_facebook" class="block text-sm/6 font-medium text-gray-900">Facebook Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_facebook" id="social_facebook" autocomplete="social_facebook"
                                               value="{{ old('social_facebook', $settings->get('social_facebook'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="social_instagram" class="block text-sm/6 font-medium text-gray-900">Instagram Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_instagram" id="social_instagram" autocomplete="social_instagram"
                                               value="{{ old('social_instagram', $settings->get('social_instagram'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="social_tiktok" class="block text-sm/6 font-medium text-gray-900">Tiktok Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_tiktok" id="social_tiktok" autocomplete="social_tiktok"
                                               value="{{ old('social_tiktok', $settings->get('social_tiktok'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="social_twitter" class="block text-sm/6 font-medium text-gray-900">Twitter Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_twitter" id="social_twitter" autocomplete="social_twitter"
                                               value="{{ old('social_twitter', $settings->get('social_twitter'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="social_linkedin" class="block text-sm/6 font-medium text-gray-900">Linkedin Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_linkedin" id="social_linkedin" autocomplete="social_linkedin"
                                               value="{{ old('social_linkedin', $settings->get('social_linkedin'))}}"
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-6">
                                    <label for="social_snapchat" class="block text-sm/6 font-medium text-gray-900">Snapchat Link</label>
                                    <div class="mt-2">
                                        <input type="text" name="social_snapchat" id="social_snapchat" autocomplete="social_snapchat"
                                               value="{{ old('social_snapchat', $settings->get('social_snapchat'))}}"
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
