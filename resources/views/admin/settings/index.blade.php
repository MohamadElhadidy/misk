<x-adminLayout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --min-width: 200px;
            --min-height: 60px;
        }
        .image-preview {
            width: var(--min-width);
            height: var(--min-height);
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .remove-btn {
            position: absolute;
            top: -5px;
            left: -5px;
            background-color: rgb(126, 4, 4);
            color: white;
            font-size: 12px;
            border-radius: 35px;
            width: 20px;
            height: 20px;
            text-align: center;
            cursor: pointer;
        }

        .upload-btn {
            padding: 10px;
            background-color: #1c1d1d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>

    <x-slot:title>
        General Settings
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
                <h2 class="text-xl font-semibold mb-4">General Settings</h2>

                <form method="POST"  action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>
                            <div x-data="imageUploader()" class="max-w-3xl p-6 bg-white shadow-md rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Store Logo</h2>

                                <!-- File Input (Hidden and triggered by the button) -->
                                <input type="file" @change="uploadImage" x-ref="fileInput" class="hidden" accept="image/*">

                                <!-- Upload Button -->
                                <button type="button" @click="$refs.fileInput.click()" class="upload-btn">
                                    Upload Logo
                                </button>

                                <!-- Uploaded Image Preview -->
                                <div class="mt-4" x-show="image">
                                    <div class="relative">
                                        <img :src="image" class="image-preview " alt="Preview">
                                        <input type="hidden" name="store_logo" :value="image">
                                        <!-- Remove Button -->
                                        <button type="button" @click="removeImage()" class="remove-btn">X</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="store_name" class="block text-sm/6 font-medium text-gray-900">Store Name</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_name" id="store_name" autocomplete="store_name"
                                               value="{{ old('store_name', $settings->get('store_name')) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="store_email" class="block text-sm/6 font-medium text-gray-900">Store Email</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_email" id="store_email" autocomplete="store_email"
                                               value="{{ old('store_email', $settings->get('store_email')) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                            </div>


                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="store_phone" class="block text-sm/6 font-medium text-gray-900">Store Phone</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_phone" id="store_phone" autocomplete="store_phone"
                                               value="{{ old('store_phone', $settings->get('store_phone')) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="store_address" class="block text-sm/6 font-medium text-gray-900">Store Address</label>
                                    <div class="mt-2">
                                        <input type="text" name="store_address" id="store_address" autocomplete="store_address"
                                               value="{{ old('store_address', $settings->get('store_address')) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="default_currency" class="block text-sm/6 font-medium text-gray-900">Default Currency</label>
                                    <div class="mt-2">
                                        <input type="text" name="default_currency" id="default_currency" autocomplete="default_currency"
                                               value="{{ old('default_currency', $settings->get('default_currency')) }}" required
                                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-3">
                                    <label for="default_language" class="block text-sm/6 font-medium text-gray-900">Default Language</label>
                                    <div class="mt-2">
                                        <input type="text" name="default_language" id="default_language" autocomplete="default_language"
                                               value="{{ old('default_language', $settings->get('default_language')) }}" required
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

    <script>
        function imageUploader() {
            let existingImage =  @json($settings->get('store_logo'));
            return {
                image: existingImage !== '' ? existingImage : null,
                minWidth: 150,  // Minimum width
                maxWidth: 300, // Maximum width
                minHeight: 40, // Minimum height
                maxHeight: 60, // Maximum height
                uploadImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            if (
                                img.width < this.minWidth || img.width > this.maxWidth ||
                                img.height < this.minHeight || img.height > this.maxHeight
                            ) {
                                alert(`Image must be between ${this.minWidth}x${this.minHeight}px and ${this.maxWidth}x${this.maxHeight}px.`);
                                this.image = null;
                            } else {
                                this.image = e.target.result;
                            }
                        };
                    };
                    reader.readAsDataURL(file);
                },
                removeImage() {
                    this.image = null;
                }
            };
        }
    </script>
</x-adminLayout>
