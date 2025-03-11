<x-adminLayout>
    <x-slot:title>
        Shipping Settings
    </x-slot>
    <x-slot:header>
        <x-admin.heading>Settings</x-admin.heading>
    </x-slot>
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <x-admin.sidebar-settings/>

        <!-- Content -->
        <main class="flex-1 p-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <h2 class="text-xl font-semibold mb-4 mx-2">Users Management</h2>

                <h1 class="text-red-600 m-2">{{ session('success') }}</h1>
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
                        <form action="/admin/settings/users/" method="get">
                            <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                                   class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Search for users">
                        </form>
                    </div>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($users->isEmpty())
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th colspan="4"
                                class=" text-center px-6 py-4 text-lg font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                No products available
                            </th>

                        </tr>
                    @else
                        @foreach ($users as $user)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->email }}
                                </th>

                                <th scope="row" class="px-6 py-4   whitespace-nowrap">
                                    <div class="flex space-x-4">
                                        @if($user->role === 'user')
                                            <form action="{{ route('user.promote', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-600">Promote to Admin</button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.downgrade', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-orange-600">Downgrade to User</button>
                                            </form>
                                        @endif
                                        @if($user->banned)
                                            <form action="{{ route('user.unban', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-600">Unban</button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.ban', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-600">Ban</button>
                                            </form>
                                        @endif
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    @endif


                    </tbody>
                </table>
                <div class="m-3">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </div>
</x-adminLayout>
