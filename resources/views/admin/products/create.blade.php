<x-adminLayout>
    <x-slot:header>
        <x-admin.heading>Create Product</x-admin.heading>
    </x-slot>
    <form method="POST" action="/admin/products">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Product Name"
            class="border border-black">
        @error('name')
            <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
        @enderror
        <input type="text" name="description" value="{{ old('description') }}" placeholder="Enter Product Description"
            class="border border-black">
        @error('description')
            <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
        @enderror
        <button type="button" onclick="clone()">Add Size</button>
        <div id="size">
            <div>
                <input type="text" name="size[]" value="{{ old('size') }}" placeholder="Enter Product Size"
                    class="border border-black">
                @error('size')
                    <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
                @enderror
                <input type="text" name="price[]" value="{{ old('price') }}" placeholder="Enter Product Description"
                    class="border border-black">
                @error('price')
                    <div style="color: red;font-size: 1.5rem">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <br>
        <input type="submit" value="Create" class="bg-black text-white rounded-xl p-2 cursor-pointer">
    </form>


    <script>
        function clone() {

            var node = document.getElementById("size");
             console.log(node);
             console.log(node.firstChild);

            var clone = node.cloneNode(true);
            document.getElementById("size").appendChild(clone);
        }
    </script>
</x-adminLayout>
