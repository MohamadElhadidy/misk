<x-adminLayout>
    <x-slot:title>
        Categories Management
    </x-slot>

    <x-slot:header>
        <x-admin.heading class="text-lg sm:text-xl">Categories Management</x-admin.heading>
        <x-admin.button href="/admin/categories/create">Create Category</x-admin.button>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h1 class="text-red-600 m-2 text-sm sm:text-base">{{ session('success') }}</h1>
        <div class="pb-4 bg-white dark:bg-gray-900 mx-2">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <form action="/admin/categories/" method="get">
                    <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                           class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for categories">
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3 sm:px-6">id</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">image</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Category name</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Action</th>
                </tr>
                </thead>
                <tbody>
                @if ($categories->isEmpty())
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th colspan="4" class="text-center px-2 py-4 text-sm sm:text-lg font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                            No categories available
                        </th>
                    </tr>
                @else
                    @foreach ($categories as $category)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-2 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white sm:px-6">
                                {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                            </th>
                            <th scope="row" class="px-2 py-4 sm:px-6">
                                <img src="{{ $category->image }}" class="w-12 sm:w-24" />
                            </th>
                            <th scope="row" class="px-2 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white sm:px-6">
                                {{ $category->name }}
                            </th>
                            <th scope="row" class="px-2 py-4 sm:px-6">
                                <div class="flex space-x-2 sm:space-x-4 justify-content-center items-center">
                                    <a href="/admin/categories/{{ $category->id }}/edit"
                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-xs sm:text-sm">Edit</a>
                                    <form action="/admin/categories/{{ $category->id }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete {{ $category->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit"
                                               class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline text-xs sm:text-sm"
                                               value="Delete">
                                    </form>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="m-3">
            {{ $categories->links() }}
        </div>
    </div>
</x-adminLayout>
