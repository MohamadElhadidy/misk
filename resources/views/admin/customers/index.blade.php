<x-adminLayout>
    <x-slot:title>
        Customers List
    </x-slot>

    <x-slot:header>
        <x-admin.heading>Customers List</x-admin.heading>
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
                <form action="/admin/customers/" method="get">
                    <input type="text" id="table-search" name="q" value="{{ request('q') }}"
                           class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for customers">
                </form>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Customer name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Orders
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Spend
                </th>
                <th scope="col" class="px-6 py-3">
                    Last Order Date
                </th>
            </tr>
            </thead>
            <tbody>
            @if ($customers->isEmpty())
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <th colspan="7"
                        class=" text-center px-6 py-4 text-lg font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                        No customers available
                    </th>

                </tr>
            @else
                @foreach ($customers as $customer)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">


                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white underline">
                           <a href="/admin/orders/?q={{$customer->name}}" target="_blank"> {{ $customer->name }}</a>
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $customer->email }}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $customer->addresses->pluck('phone_number')->implode(', ') }}                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$customer->totalOrders()}}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $customer->totalSpend() }} {{config('app.currency')}}
                        </th>

                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$customer->lastOrderDate()}}
                        </th>
                    </tr>
                @endforeach
            @endif


            </tbody>
        </table>
        <div class="m-3">
            {{ $customers->links() }}
        </div>
    </div>


</x-adminLayout>
