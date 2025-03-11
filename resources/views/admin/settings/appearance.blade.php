<x-adminLayout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --min-width: 990px;
            --min-height: 800px;
        }
        .image-preview {
            width: var(--min-width);
            height: var(--min-height);
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .image-preview-favicon {
            width: 150px;
            height: 150px;
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
                <h2 class="text-xl font-semibold mb-4">Appearance Settings</h2>

                <form method="POST"  action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h1 class="text-green-600 my-6">{{ session('success') }}</h1>
                            <div x-data="imageUploaderFavicon()" class="max-w-3xl p-6 bg-white shadow-md rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Store Favicon</h2>

                                <!-- File Input (Hidden and triggered by the button) -->
                                <input type="file" @change="uploadImage" x-ref="fileInput" class="hidden" accept="image/*">

                                <!-- Upload Button -->
                                <button type="button" @click="$refs.fileInput.click()" class="upload-btn">
                                    Upload Favicon
                                </button>

                                <!-- Uploaded Image Preview -->
                                <div class="mt-4" x-show="favicon">
                                    <div class="relative">
                                        <img :src="favicon" class="image-preview-favicon " alt="Preview">
                                        <input type="hidden" name="favicon" :value="favicon">
                                        <!-- Remove Button -->
                                        <button type="button" @click="removeImage()" class="remove-btn">X</button>
                                    </div>
                                </div>
                            </div>


                            <div x-data="imageUploader()" class="max-w-3xl p-6 bg-white shadow-md rounded-lg">
                                <h2 class="text-xl font-semibold mb-4">Store Banner</h2>

                                <!-- File Input (Hidden and triggered by the button) -->
                                <input type="file" @change="uploadImage" x-ref="fileInput" class="hidden" accept="image/*">

                                <!-- Upload Button -->
                                <button type="button" @click="$refs.fileInput.click()" class="upload-btn">
                                    Upload Banner
                                </button>

                                <!-- Uploaded Image Preview -->
                                <div class="mt-4" x-show="image">
                                    <div class="relative">
                                        <img :src="image" class="image-preview " alt="Preview">
                                        <input type="hidden" name="banner_1" :value="image">
                                        <!-- Remove Button -->
                                        <button type="button" @click="removeImage()" class="remove-btn">X</button>
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
            let existingImage =  @json($settings->get('banner_1'));
            return {
                image: existingImage !== '' ? existingImage : null,
                Width: 990,  // Minimum width
                Height: 800, // Minimum height
                uploadImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            if (
                                img.width < this.Width || img.height < this.Height
                            ) {
                                console.log( img.width, img.height)
                                alert(`Banner must be greater than ${this.Width}x${this.Height}px.`);
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


        function imageUploaderFavicon() {
            let existingFavicon =  @json($settings->get('favicon'));
            return {
                favicon: existingFavicon !== '' ? existingFavicon : null,
                uploadImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.favicon = e.target.result; // Set the favicon directly from the file reader result
                    };
                    reader.readAsDataURL(file);
                },
                removeImage() {
                    this.favicon = null;
                }
            };
        }
    </script>
</x-adminLayout>
