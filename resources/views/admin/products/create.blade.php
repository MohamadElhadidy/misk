<x-adminLayout>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .image-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .remove-btn {
            position: absolute;
            top: -5px;
            right: -1px;
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

    <x-slot:header>
        <x-admin.heading>Create Product</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/products" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create a new Product</h2>
                <p class="mt-1 text-sm/6 text-gray-600">We need some info from you.</p>

                <div x-data="imageUploader()" class="max-w-3xl  p-6 bg-white shadow-md rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Product Images</h2>

                    <!-- File Input (Hidden and triggered by the button) -->
                    <input type="file" multiple @change="uploadImages" x-ref="fileInput" class="hidden"
                        accept="image/*" name="images[]">

                    <!-- Upload Button -->
                    <button @click="$refs.fileInput.click()" class="upload-btn">
                        Upload
                    </button>

                    <!-- Uploaded Image Previews -->
                    <div class="flex flex-wrap gap-2 mt-4 space-y-10">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="relative">
                                <img :src="image" class="image-preview" alt="Preview">
                                <!-- Remove Button -->
                                <button @click="removeImage(index)" class="remove-btn">X</button>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="name"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="category_id" class="block text-sm/6 font-medium text-gray-900">Category</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="category_id" name="category_id" autocomplete="category_id" required
                                class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <option value="" disabled selected>Choose a category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach


                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="sm:col-span-6">
                        <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Product
                            Description</label>
                        <div class="mt-2" id="editor"></div>
                        <input type="hidden" name="description" id="quillContent">
                    </div>


                </div>

                <div class="border-b border-gray-900/10 pb-12 mt-12"></div>

                <div class="pt-6" x-data="productForm()">
                    <h2 class="text-base/7 font-semibold text-gray-900">Product Sizes</h2>
                    <p class="mt-1 text-sm/6 text-gray-600">Here are the sizes and prices for each option in the
                        product.</p>
                    <div class="mt-6">
                        <button type="button" class="flex items-center space-x-2" @click="addSize()">
                            <svg class="w-8" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">

                                <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />

                                <g id="SVGRepo_iconCarrier">
                                    <title>plus</title>
                                    <desc>Created with Sketch Beta.</desc>
                                    <defs> </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        sketch:type="MSPage">
                                        <g id="Icon-Set" sketch:type="MSLayerGroup"
                                            transform="translate(-360.000000, -1035.000000)" fill="#008421">
                                            <path
                                                d="M388,1053 L378,1053 L378,1063 C378,1064.1 377.104,1065 376,1065 C374.896,1065 374,1064.1 374,1063 L374,1053 L364,1053 C362.896,1053 362,1052.1 362,1051 C362,1049.9 362.896,1049 364,1049 L374,1049 L374,1039 C374,1037.9 374.896,1037 376,1037 C377.104,1037 378,1037.9 378,1039 L378,1049 L388,1049 C389.104,1049 390,1049.9 390,1051 C390,1052.1 389.104,1053 388,1053 L388,1053 Z M388,1047 L380,1047 L380,1039 C380,1036.79 378.209,1035 376,1035 C373.791,1035 372,1036.79 372,1039 L372,1047 L364,1047 C361.791,1047 360,1048.79 360,1051 C360,1053.21 361.791,1055 364,1055 L372,1055 L372,1063 C372,1065.21 373.791,1067 376,1067 C378.209,1067 380,1065.21 380,1063 L380,1055 L388,1055 C390.209,1055 392,1053.21 392,1051 C392,1048.79 390.209,1047 388,1047 L388,1047 Z"
                                                id="plus" sketch:type="MSShapeGroup"> </path>
                                        </g>
                                    </g>
                                </g>

                            </svg>
                            <span class="hover:text-green-800"> Add Size</span>
                        </button>
                    </div>
                    <template x-for="(size, index) in sizes" :key="index">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 ">
                            <div class="sm:col-span-5">
                                <label for="size" class="block text-sm/6 font-medium text-gray-900">Product
                                    Size</label>
                                <div class="mt-2">
                                    <input type="text" name="sizes[]" x-model="size.name" id="size"
                                        autocomplete="sizes[]"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                </div>
                            </div>
                            <div class="sm:col-span-5">
                                <label for="price" class="block text-sm/6 font-medium text-gray-900">Product
                                    Price</label>
                                <div class="mt-2">
                                    <input type="text" name="prices[]" x-model="size.price" id="price"
                                        autocomplete="prices[]"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                </div>
                            </div>

                            <div class="sm:col-span-2 flex items-end">
                                <button type="button" @click="removeSize(index)" x-show="sizes.length > 1">
                                    <svg class="w-10" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4"
                                                stroke="#880000" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M20.5 6H3.49988" stroke="#880000" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path
                                                d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5"
                                                stroke="#880000" stroke-width="1.5" stroke-linecap="round" />
                                            <path d="M9.5 11L10 16" stroke="#880000" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path d="M14.5 11L14 16" stroke="#880000" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </g>

                                    </svg>
                                </button>

                            </div>

                        </div>
                    </template>


                </div>

                {{-- <div class="mt-10 space-y-10 border-t border-gray-900/10">
                    <fieldset>
                        <div class="mt-6 space-y-6">
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <div class="group grid size-4 grid-cols-1">
                                        <input id="featured" aria-describedby="featured" name="featured"
                                            type="checkbox"
                                            class="col-start-1 row-start-1 appearance-none rounded-sm border border-gray-300 bg-white checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:checked:bg-gray-100 forced-colors:appearance-auto">
                                        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-disabled:stroke-gray-950/25"
                                            viewBox="0 0 14 14" fill="none">
                                            <path class="opacity-0 group-has-checked:opacity-100" d="M3 8L6 11L11 3.5"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path class="opacity-0 group-has-indeterminate:opacity-100" d="M3 7H11"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="text-sm/6">
                                    <label for="featured" class="font-medium text-gray-900">Featured Product</label>
                                    <p id="featured" class="text-gray-500">Here is your Featured Product To
                                        On The Home Page.</p>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                </div> --}}
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/admin/categories" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>

    </form>


    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        document.querySelector('form').onsubmit = function() {
            document.getElementById('quillContent').value = quill.root.innerHTML;
        };
    </script>

    <script>
        function productForm() {
            return {
                sizes: [{
                        name: '',
                        price: ''
                    } // Default size field
                ],
                addSize() {
                    this.sizes.push({
                        name: '',
                        price: ''
                    });
                },
                removeSize(index) {
                    this.sizes.splice(index, 1);
                }
            }
        }

        function imageUploader() {
            return {
                images: [],
                // Handle image selection (multiple files allowed)
                uploadImages(event) {
                    const files = event.target.files;
                    if (!files.length) return;

                    // Iterate through each selected file and preview them one by one
                    for (let i = 0; i < files.length; i++) {
                        let reader = new FileReader();
                        reader.onload = (e) => {
                            this.images.push(e.target.result); // Add each image to the list
                        };
                        reader.readAsDataURL(files[i]);
                    }
                },

                // Remove selected image
                removeImage(index) {
                    this.images.splice(index, 1); // Remove image from the preview list
                }
            };
        }
    </script>
</x-adminLayout>
