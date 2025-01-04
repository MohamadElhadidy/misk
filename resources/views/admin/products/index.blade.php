<x-adminLayout>
    <x-slot:header>
        <x-admin.heading>Products Management</x-admin.heading>
        <x-admin.button href="/admin/products/create">Create Product</x-admin.button>
    </x-slot>

    <h1 class="text-green-600">{{ session('message') }}</h1>
    <table>

        <head>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th></th>
            </tr>
        </head>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="flex space-x-2">
                        <a href="/admin/products/{{ $product->id }}/edit" class="text-yellow-700">Edit</a>
                        <form action="/admin/products/{{ $product->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="text-red-700 cursor-pointer" value="Delete">
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-adminLayout>
