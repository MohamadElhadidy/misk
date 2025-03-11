<x-adminLayout>
    <x-slot:header>
        <x-admin.heading>Dashboard</x-admin.heading>
    </x-slot>
    <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$total_orders}}</span>
                    <h3 class="text-base font-normal text-gray-500">Total Orders</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <svg class="w-12 h-12" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#B1C6E4;" d="M320.794,199.54l-26.293-98.13c-5.271-19.685-21.283-34.055-40.804-36.619 c-12.66-1.648-25.292-2.443-37.862-2.583l57.337,209.88c10.474-6.256,20.759-12.92,30.591-20.449 C319.391,239.671,326.076,219.214,320.794,199.54z"></path> <path style="fill:#C5DCFD;" d="M21.25,127.073C5.62,139.04-1.065,159.497,4.217,179.181l26.293,98.13 c5.271,19.695,21.294,34.065,40.804,36.609c13.605,1.771,27.177,2.649,40.677,2.682L52.018,106.327 C41.458,112.621,31.16,119.486,21.25,127.073z"></path> <path style="fill:#DBE9FD;" d="M215.832,62.206c-18.188-0.203-36.389,1.332-54.441,4.296 c-37.777,6.202-74.845,19.247-109.373,39.825l59.974,210.275c0.252,0.001,0.505,0.025,0.758,0.025 c16.047,0,32.334-1.446,48.641-4.056c38.075-6.094,76.261-19.27,111.78-40.485L215.832,62.206z"></path> <path style="fill:#C5DCFD;" d="M215.832,62.206c-18.188-0.203-36.389,1.332-54.441,4.296V312.57 c38.075-6.094,76.261-19.27,111.78-40.485L215.832,62.206z"></path> <path style="fill:#A1A9AF;" d="M333.913,282.855H16.696C7.473,282.855,0,290.334,0,299.551v66.783 c0,9.217,7.473,16.696,16.696,16.696h317.217V282.855z"></path> <rect x="150.261" y="282.858" style="fill:#8A9096;" width="183.652" height="100.174"></rect> <path style="fill:#6E6057;" d="M116.87,449.812c-27.619,0-50.087-22.468-50.087-50.087s22.468-50.087,50.087-50.087 s50.087,22.468,50.087,50.087S144.489,449.812,116.87,449.812z"></path> <path style="fill:#615349;" d="M166.957,399.725c0-27.619-22.468-50.087-50.087-50.087v100.174 C144.489,449.812,166.957,427.344,166.957,399.725z"></path> <path style="fill:#8EB043;" d="M374.762,82.508h-57.544c-9.238,0-16.696,7.457-16.696,16.696v217.043v50.087v16.696h161.391 c27.603,0,50.087-22.483,50.087-50.087V219.746C512,144.058,450.449,82.508,374.762,82.508z"></path> <path style="fill:#615349;" d="M512,219.745v29.718H384c-9.238,0-16.696-7.457-16.696-16.696V82.507h7.457 C450.449,82.508,512,144.058,512,219.745z"></path> <path style="fill:#6E6057;" d="M395.13,449.812c-27.619,0-50.087-22.468-50.087-50.087s22.468-50.087,50.087-50.087 c27.619,0,50.087,22.468,50.087,50.087S422.749,449.812,395.13,449.812z"></path> <path style="fill:#615349;" d="M445.217,399.725c0-27.619-22.468-50.087-50.087-50.087v100.174 C422.749,449.812,445.217,427.344,445.217,399.725z"></path> <path style="fill:#C5DCFD;" d="M512,282.855h-50.087c-9.223,0-16.696,7.479-16.696,16.696c0,9.217,7.473,16.696,16.696,16.696H512 V282.855z"></path> <path style="fill:#DBE9FD;" d="M116.87,383.029c-9.206,0-16.696,7.49-16.696,16.696c0,9.206,7.49,16.696,16.696,16.696 s16.696-7.49,16.696-16.696C133.565,390.519,126.076,383.029,116.87,383.029z"></path> <path style="fill:#C5DCFD;" d="M133.565,399.725c0-9.206-7.49-16.696-16.696-16.696v33.391 C126.076,416.421,133.565,408.931,133.565,399.725z"></path> <path style="fill:#DBE9FD;" d="M395.13,383.029c-9.206,0-16.696,7.49-16.696,16.696c0,9.206,7.49,16.696,16.696,16.696 c9.206,0,16.696-7.49,16.696-16.696C411.826,390.519,404.336,383.029,395.13,383.029z"></path> <path style="fill:#C5DCFD;" d="M411.826,399.725c0-9.206-7.49-16.696-16.696-16.696v33.391 C404.336,416.421,411.826,408.931,411.826,399.725z"></path> </g></svg>

                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$delivered_orders}}</span>
                    <h3 class="text-base font-normal text-gray-500">Delivered Orders</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                    <svg class="w-12 h-12" viewBox="0 0 48 48" version="1" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#8BC34A" d="M43,36H29V14h10.6c0.9,0,1.6,0.6,1.9,1.4L45,26v8C45,35.1,44.1,36,43,36z"></path> <path fill="#388E3C" d="M29,36H5c-1.1,0-2-0.9-2-2V9c0-1.1,0.9-2,2-2h22c1.1,0,2,0.9,2,2V36z"></path> <g fill="#37474F"> <circle cx="37" cy="36" r="5"></circle> <circle cx="13" cy="36" r="5"></circle> </g> <g fill="#78909C"> <circle cx="37" cy="36" r="2"></circle> <circle cx="13" cy="36" r="2"></circle> </g> <path fill="#37474F" d="M41,25h-7c-0.6,0-1-0.4-1-1v-7c0-0.6,0.4-1,1-1h5.3c0.4,0,0.8,0.3,0.9,0.7l1.7,5.2c0,0.1,0.1,0.2,0.1,0.3V24 C42,24.6,41.6,25,41,25z"></path> <polygon fill="#DCEDC8" points="21.8,13.8 13.9,21.7 10.2,17.9 8,20.1 13.9,26 24,15.9"></polygon> </g></svg>

                </div>
            </div>
        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$total_revenue}} {{config('app.currency')}}</span>
                    <h3 class="text-base font-normal text-gray-500">Revenue</h3>
                </div>
                <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                    <svg class="w-12 h-12" viewBox="0 0 1024 1024"  version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M853.333333 874.666667H170.666667c-46.933333 0-85.333333-38.4-85.333334-85.333334V343.466667c0-27.733333 12.8-53.333333 36.266667-70.4L512 0l390.4 273.066667c23.466667 14.933333 36.266667 42.666667 36.266667 70.4V789.333333c0 46.933333-38.4 85.333333-85.333334 85.333334z" fill="#78909C"></path><path d="M298.666667 21.333333h426.666666v661.333334H298.666667z" fill="#AED581"></path><path d="M277.333333 0v704h469.333334V0H277.333333z m426.666667 661.333333H320V42.666667h384v618.666666z" fill="#558B2F"></path><path d="M725.333333 64c0 36.266667-6.4 64-42.666666 64s-64-27.733333-64-64 27.733333-42.666667 64-42.666667 42.666667 6.4 42.666666 42.666667zM341.333333 21.333333c36.266667 0 64 6.4 64 42.666667s-27.733333 64-64 64-42.666667-27.733333-42.666666-64 6.4-42.666667 42.666666-42.666667z" fill="#558B2F"></path><path d="M512 170.666667m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" fill="#558B2F"></path><path d="M512 426.666667m-128 0a128 128 0 1 0 256 0 128 128 0 1 0-256 0Z" fill="#558B2F"></path><path d="M853.333333 874.666667H170.666667c-46.933333 0-85.333333-38.4-85.333334-85.333334V362.666667l426.666667 277.333333 426.666667-277.333333v426.666666c0 46.933333-38.4 85.333333-85.333334 85.333334z" fill="#CFD8DC"></path></g></svg>

                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 2xl:grid-cols-3 xl:gap-4 my-4">

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full " >
            <div class="flex items-center justify-between mb-4 my-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Overview</h3>
            </div>
            <div class="flow-root my-4">
                <ul role="list" class="divide-y divide-gray-200">


                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    Total Customers
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $customer_count }}
                            </div>
                        </div>
                    </li>
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    Total Orders
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $total_orders }}
                            </div>
                        </div>
                    </li>

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    Delivered Orders
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $delivered_orders }}
                            </div>
                        </div>
                    </li>


                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    Total Revenue
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $total_revenue }} {{ config('app.currency') }}
                            </div>
                        </div>
                    </li>

                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    Total Products
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $total_products }}
                            </div>
                        </div>
                    </li>



                </ul>
            </div>
        </div>


        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full my-4 ">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Top Customers</h3>
                <h3 class="text-md font-bold leading-none text-gray-700"> Total Spent</h3>

                {{--                <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">--}}
{{--                    View all--}}
{{--                </a>--}}
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">

                    @if($top_customers->count() > 0)
                        @foreach($top_customers as $customer)
                        <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
{{--                            <div class="flex-shrink-0">--}}
{{--                                <img class="h-8 w-8 rounded-full" src="https://demo.themesberg.com/windster/images/users/neil-sims.png" alt="Neil image">--}}
{{--                            </div>--}}
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $customer->name }}
                                </p>
{{--                                <p class="text-sm text-gray-500 truncate">--}}
{{--                                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>--}}
{{--                                </p>--}}
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                {{ $customer->total_spent }} {{ config('app.currency') }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                        <tr class="text-center">
                            <td  colspan="2" >No Customers Yet!</td>
                        </tr>
                    @endif

                </ul>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold leading-none text-gray-900">Top Products</h3>
                <h3 class="text-md font-bold leading-none text-gray-700"> Total Sales</h3>

                {{--                <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">--}}
                {{--                    View all--}}
                {{--                </a>--}}
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200">

                    @if($top_products->count() > 0)
                        @foreach($top_products as $product)
                            @php
                                $p = \App\Models\Product::find($product->id);
                            @endphp
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                   <div class="flex-shrink-0">
                                             <img class="h-12 w-12 rounded-full" src="{{ '/storage/' . $p->images->first()?->path }}" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $product->name }}
                                        </p>
                                        {{-- <p class="text-sm text-gray-500 truncate">--}}
                                        {{--<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="17727a767e7b57607e7973646372653974787a">[email&#160;protected]</a>--}}
                                        {{-- </p>--}}
                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        {{ $product->total_sales }} {{ config('app.currency') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td  colspan="2" >No Customers Yet!</td>
                        </tr>
                    @endif

                </ul>
            </div>
        </div>
    </div>

</x-adminLayout>
