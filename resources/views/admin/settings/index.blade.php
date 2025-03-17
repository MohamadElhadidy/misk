<x-adminLayout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    :root {
        --min-width: 200px;
        --min-height: 60px;
    }
</style>
    <x-slot:title>
        General Settings
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Settings</x-admin.heading>
    </x-slot>
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar-settings/>

        <!-- Content -->
        <main class="flex-1 p-4 sm:p-6">
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">General Settings</h2>

                <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>
                            <div x-data="imageUploader()" class="max-w-full sm:max-w-3xl p-4 sm:p-6 bg-white shadow-md rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Store Logo</h2>

                                <input type="file" @change="uploadImage" x-ref="fileInput" class="hidden" accept="image/*">
                                <button type="button" @click="$refs.fileInput.click()" class="upload-btn">Upload Logo</button>

                                <div class="mt-4" x-show="image">
                                    <div class="relative">
                                        <img :src="image" class="image-preview max-w-full h-auto" alt="Preview">
                                        <input type="hidden" name="store_logo" :value="image">
                                        <button type="button" @click="removeImage()" class="remove-btn">X</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                                <div>
                                    <label for="store_name" class="block text-sm font-medium text-gray-900">Store Name</label>
                                    <input type="text" name="store_name" id="store_name" value="{{ old('store_name', $settings->get('store_name')) }}" required
                                           class="w-full mt-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="store_email" class="block text-sm font-medium text-gray-900">Store Email</label>
                                    <input type="text" name="store_email" id="store_email" value="{{ old('store_email', $settings->get('store_email')) }}" required
                                           class="w-full mt-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>

                            <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-8">
                                <div>
                                    <label for="store_phone" class="block text-sm font-medium text-gray-900">Store Phone</label>
                                    <input type="text" name="store_phone" id="store_phone" value="{{ old('store_phone', $settings->get('store_phone')) }}" required
                                           class="w-full mt-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="store_address" class="block text-sm font-medium text-gray-900">Store Address</label>
                                    <input type="text" name="store_address" id="store_address" value="{{ old('store_address', $settings->get('store_address')) }}" required
                                           class="w-full mt-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>

                            <div class="mt-10">
                                <label for="default_currency" class="block text-sm font-medium text-gray-900">Default Currency</label>
                                <input type="text" name="default_currency" id="default_currency" value="{{ old('default_currency', $settings->get('default_currency')) }}" required
                                       class="w-full mt-2 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-500 focus:outline-none">Update
                            </button>
                        </div>
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
