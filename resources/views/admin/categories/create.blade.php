<x-adminLayout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <x-slot:title>
        Create Category
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Create Category</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/categories" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <h2 class="text-base/7 font-semibold text-gray-900">Create a new category</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We need some info from you.</p>
                <div x-data="imageValidation()" class="sm:col-span-2 col-span-2 sm:col-start-1">
                    <label for="image" class="block text-sm/6 font-medium text-gray-900">Category Image</label>
                    <div class="mt-2">
                        <!-- Image Input Field -->
                        <div x-show="imagePreview" class="my-2">
                            <img :src="imagePreview" alt="Image preview" class="max-w-full h-auto rounded-md">
                        </div>
                        <input type="file" name="image" id="image" autocomplete="image" accept="image/*"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline cursor-pointer outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            @change="validateImage($event)">

                        <!-- Image Preview -->


                        <!-- Validation Errors -->
                        <div x-show="errorMessage" style="color: red; font-size: 1rem" x-text="errorMessage"></div>
                        @error('image')
                            <div style="color: red; font-size: 1rem" id="imageErrors">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-2 col-span-2 sm:col-start-1">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="name" required
                            value="{{ old('name') }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('name')
                            <div style="color: red;font-size: 1rem">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h1 class="text-green-600">{{ session('success') }}</h1>
                <h1 class="text-red-600">{{ session('error') }}</h1>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/admin/categories" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
            </button>
        </div>
    </form>


    <script>
        function imageValidation() {
            return {
                imagePreview: null, // Stores the image preview URL
                errorMessage: null, // Stores validation error message

                validateImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        // Reset any previous errors
                        this.errorMessage = null;

                        // Check file size (2MB max)
                        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                        if (file.size > maxSize) {
                            this.errorMessage = 'The image file size is too large. Max size: 2MB.';
                            this.clearInput();
                            return; // Exit if size is too large
                        }

                        // Create an image object to check width/height
                        const img = new Image();
                        const reader = new FileReader();

                        reader.onload = () => {
                            this.imagePreview = reader.result; // Set preview image

                            img.onload = () => {
                                const width = img.width;
                                const height = img.height;
                                const maxWidth = 500; // Max allowed width
                                const maxHeight = 500; // Max allowed height

                                // Validate image dimensions
                                if (width > maxWidth || height > maxHeight) {
                                    this.errorMessage =
                                        `The image dimensions are too large. Max width: ${maxWidth}px, Max height: ${maxHeight}px.`;
                                    this.clearInput();
                                    this.imagePreview = null; // Clear the preview
                                }
                            };

                            img.src = reader.result;
                        };

                        reader.readAsDataURL(file); // Read the image file as a data URL
                    }
                },
                clearInput() {
                    const fileInput = document.getElementById('image');
                    fileInput.value = ''; // Clear the file input field

                    const imageErrors = document.getElementById('imageErrors');
                    imageErrors && (imageErrors.innerHTML = ''); // Clears the error message if element exists
                }
            };
        }
    </script>


</x-adminLayout>
