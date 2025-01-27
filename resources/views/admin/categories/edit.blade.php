<x-adminLayout>
    <x-slot:header>
        <x-admin.heading>Edit Category</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/categories/{{ $category->id }}">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <h2 class="text-base/7 font-semibold text-gray-900">Update category</h2>
                <div class="sm:col-span-2 col-span-2 sm:col-start-1">
                    <label for="name" class="block text-sm/6 font-medium text-gray-900">Category</label>
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

</x-adminLayout>
