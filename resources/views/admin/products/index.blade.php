<x-adminLayout>
    <x-slot:title>
        Products Management
    </x-slot>
    <x-slot:header>
            <x-admin.heading class="text-lg sm:text-xl">Products Management</x-admin.heading>
            <x-admin.button href="/admin/products/create">Create Product</x-admin.button>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h1 class="text-red-600 m-2">{{ session('success') }}</h1>

        <!-- Search Form -->
        <div class="pb-4 bg-white dark:bg-gray-900 mx-2">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <form action="/admin/products/" method="get">
                    <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                           class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for products">
                </form>
            </div>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">ID</th>
                    <th scope="col" class="px-4 py-3">Image</th>
                    <th scope="col" class="px-4 py-3">Product Name</th>
                    <th scope="col" class="px-4 py-3">Action</th>
                </tr>
                </thead>
                <tbody>
                @if ($products->isEmpty())
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td colspan="4" class="text-center px-6 py-4 text-lg font-semibold text-gray-900 dark:text-white">
                            No products available
                        </td>
                    </tr>
                @else
                    @foreach ($products as $product)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>
                            <td class="px-4 py-3">
                                <img src="{{  $product->images->first()?->path }}" class="w-24 h-auto" />
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
                                    <a href="/admin/products/{{ $product->id }}/edit"
                                       class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <form action="/admin/products/{{ $product->id }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete {{ $product->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                               class="cursor-pointer text-red-600 dark:text-red-500 hover:underline"
                                               value="Delete">
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="m-3">
            {{ $products->links() }}
        </div>
    </div>
</x-adminLayout>
