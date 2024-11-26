<x-adminLayout>
    <form method="POST" action="/admin/categories">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Categoty Name"
            class="border border-black">
        @error('name')
            <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
        @enderror
        <input type="submit" value="Create" class="bg-black text-white rounded-xl p-2 cursor-pointer">
    </form>
</x-adminLayout>
