<x-adminLayout>
    <x-slot:title>
        Orders Management
    </x-slot>

    <x-slot:header>
        <x-admin.heading class="text-lg sm:text-xl">Orders Management</x-admin.heading>
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
                <form action="/admin/orders/" method="get">
                    <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                           class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for orders">
                </form>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3 sm:px-6">Order id</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">User</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Address</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Total Price</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Status</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Created at</th>
                    <th scope="col" class="px-2 py-3 sm:px-6">Action</th>
                </tr>
                </thead>
                <tbody>
                @if ($orders->isEmpty())
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th colspan="7" class="text-center px-2 py-4 text-sm sm:text-lg font-semibold text-gray-900 dark:text-white">
                            No orders available
                        </th>
                    </tr>
                @else
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 dark:text-white underline sm:px-6">
                                <a href="{{ route('orders.show', $order->order_id) }}" class="hover:text-blue-600" target="_blank">{{ $order->order_id }}</a>
                            </th>
                            <td class="px-2 py-4 text-sm sm:text-base font-medium text-gray-900 dark:text-white sm:px-6">
                                {{ $order->customer->name }}
                            </td>
                            <td class="px-2 py-4 text-sm sm:text-base font-medium text-gray-900 dark:text-white sm:px-6">
                                {{ $order->address->country }} - {{ $order->address->city }}
                            </td>
                            <td class="px-2 py-4 text-sm sm:text-base font-medium text-gray-900 dark:text-white sm:px-6">
                                {{ $order->total_price }} {{ config('app.currency') }}
                            </td>
                            <td class="px-2 py-4 sm:px-6">
                                <span style="background-color: {{ $order->status_color }};" class="text-white font-semibold p-1 sm:p-2 rounded-2xl text-xs sm:text-sm">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="px-2 py-4 text-sm sm:text-base font-medium text-gray-900 dark:text-white sm:px-6">
                                {{ $order->created_at }}
                            </td>
                            <td class="px-2 py-4 sm:px-6">
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="text-sm sm:text-base border border-gray-300 rounded-md bg-white dark:bg-gray-700 dark:text-white">
                                        @foreach (App\Models\Order::STATUSES as $status)
                                            <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="m-3">
            {{ $orders->links() }}
        </div>
    </div>


</x-adminLayout>
