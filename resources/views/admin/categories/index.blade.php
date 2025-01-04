<x-adminLayout>
    <x-slot:header>
        <x-admin.heading>Categories Management</x-admin.heading>
        <x-admin.button href="/admin/categories/create">Create Category</x-admin.button>
    </x-slot>


    <table>

        <head>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th></th>
            </tr>
        </head>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="flex space-x-2">
                        <a href="/admin/categories/{{ $category->id }}/edit" class="text-yellow-700">Edit</a>
                        <form action="/admin/categories/{{ $category->id }}" method="POST">
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
