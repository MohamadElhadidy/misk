<x-adminLayout>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --min-width: 500px;
            --min-height: 500px;
        }
    </style>

    <x-slot:title>
        Edit Category
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Edit Category</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/categories/{{ $category->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <h2 class="text-base/7 font-semibold text-gray-900">Update category</h2>
                <div x-data="imageUploader()" class="max-w-full sm:max-w-3xl p-4 sm:p-6 bg-white shadow-md rounded-lg mb-6">
                    <h2 class="text-xl font-semibold mb-4">Category Image</h2>

                    <input type="file" @change="uploadImage" x-ref="fileInput" class="hidden" accept="image/*">
                    <button type="button" @click="$refs.fileInput.click()" class="upload-btn">Upload Image</button>

                    <div class="mt-4" x-show="image">
                        <div class="relative">
                            <img :src="image" class="image-preview max-w-full h-auto" alt="Preview">
                            <input type="hidden" name="image" :value="image">
                            <button type="button" @click="removeImage()" class="remove-btn">X</button>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-2 col-span-2 sm:col-start-1">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="name"
                            value="{{ old('name', $category->name) }}"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        @error('name')
                            <div style="color: red;font-size: 1rem">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <h1 class="text-green-600">{{ session('success') }}</h1>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/admin/categories" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
    <script>
        function imageUploader() {
            let existingImage =  @json($category->image);
            return {
                image: existingImage !== '' ? existingImage : null,
                height: 180, // Minimum height
                width: 180, // Maximum height
                uploadImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            if (
                                img.width < this.width || img.height < this.height
                            ) {
                                alert(`Image must be greeter than ${this.width}x${this.height}px `);
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
