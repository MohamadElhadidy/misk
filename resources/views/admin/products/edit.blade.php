<x-adminLayout>
     <x-slot:header>
        <x-admin.heading>Edit Product</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/categories/{{ $category->id }}">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter Categoty Name"
            class="border border-black">
        @error('name')
            <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
        @enderror
        <input type="submit" value="Create" class="bg-black text-white rounded-xl p-2 cursor-pointer">
    </form>
</x-adminLayout>
