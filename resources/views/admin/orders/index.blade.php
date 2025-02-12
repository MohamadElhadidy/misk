<x-adminLayout>
    <x-slot:title>
        Orders Management
    </x-slot>

    <x-slot:header>
        <x-admin.heading>Orders Management</x-admin.heading>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                <form action="/admin/orders/" method="get">
                    <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                           class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for orders">
                </form>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th scope="col" class="px-6 py-3">
                    Order id
                </th>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Created at
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @if ($orders->isEmpty())
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th colspan="7"
                        class=" text-center px-6 py-4 text-lg font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                        No orders available
                    </th>

                </tr>
            @else
                @foreach ($orders as $order)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white underline">
                            <a href="{{route('orders.show', $order->id)}}" class="hover:text-blue-600" target="_blank">{{ $order->order_id}}</a>
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->user->name }}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{  $order->address->country }} - {{  $order->address->city }}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->total_price  }} {{ config('app.currency') }}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium  whitespace-nowrap text-white" >
                            <span style="background-color: {{ $order->status_color }};" class="text-white font-semibold p-2 rounded-2xl">{{ ucfirst($order->status) }}</span>
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $order->created_at }}
                        </th>

                        <th scope="row" class="px-6 py-4   whitespace-nowrap">
                            <div class="flex space-x-4">
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()">
                                        @foreach (App\Models\Order::STATUSES as $status)
                                            <option  value="{{ $status }}"  {{ $order->status == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </th>
                    </tr>
                @endforeach
            @endif


            </tbody>
        </table>
        <div class="m-3">
            {{ $orders->links() }}
        </div>
    </div>


</x-adminLayout>
