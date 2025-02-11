<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>

    <main class="main-bg">
        <section class="checkout-section pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="checkout-wrapper" data-aos="fade-up" data-aos-duration="1200">
                            <form class="checkout-form" method="POST" action="{{route('checkout.store')}}">
                                @csrf
                                <!-- show all validation erros -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="text-red-500">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
                                <input type="hidden" name="total_price" value="{{ $totalPrice + 30 }}">
                                <div class="row">
                                    <div class="col-xl-7">
                                        <div class="billing-wrapper" x-data="addressSelection()">
                                            <h3 class="title">Billing details</h3>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" disabled class="form_control"
                                                            value="{{ auth()->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form_group">
                                                        <label>Email address</label>
                                                        <input type="email" class="form_control" disabled
                                                            value="{{ auth()->user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Choose an address<span>*</span></label>
                                                        <select x-model="selectedAddress" name="address" style="padding: 15px 20px;"
                                                            @change="handleAddressChange" required
                                                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                                            <option disabled selected value="">Choose an address
                                                            </option>
                                                            @foreach (auth()->user()->addresses as $address)
                                                                <option value="{{ $address->id }}" {{ old('address') == $address->id || $address->is_default ? 'selected' : '' }}>
                                                                    <!-- address_line_1 -->
                                                                {{ $address->country }} - {{ $address->city }} - {{ $address->address_line_1 }} - {{ $address->address_line_2 }}  - {{ $address->phone_number }} </option>
                                                            @endforeach
                                                            <option value="new">Add
                                                                new address</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                </div>
                                                <!-- New Address Form -->
                                                <div  class="row mt-10" x-show="showNewAddressForm" x-transition>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Country / Region<span>*</span></label>
                                                            <select class="wide" id="country"  x-bind:required="showNewAddressForm" name="country">
                                                                <option>Egypt</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Town / City <span>*</span></label>
                                                            <input type="text" class="form_control" name="city"
                                                                placeholder="Ex: Cairo"  x-bind:required="showNewAddressForm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form_group">
                                                            <label>Street address<span>*</span></label>
                                                            <input type="text" class="form_control" name="address_line_1"
                                                                placeholder="Ex:  Muizz Street"  x-bind:required="showNewAddressForm">
                                                            <input type="text" class="form_control" name='address_line_2'
                                                                placeholder="Ex:  Muizz Street"  x-bind:required="showNewAddressForm">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-6">
                                                        <div class="form_group">
                                                            <label>Phone Number <span>*</span></label>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex: +201557809982" name="phone_number"
                                                                x-bind:required="showNewAddressForm">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Postcode / Zip <span>*</span></label>
                                                            <input type="text" class="form_control" name="postal_code"
                                                                placeholder="Ex:  45613"  x-bind:required="showNewAddressForm">
                                                        </div>
                                                    </div>
                                                </div>

                                            
                                        </div>

                                    </div>
                                    <div class="col-xl-5">
                                        <div class="order-summary-wrapper mb-30">
                                            <h3 class="title">Billing details</h3>
                                            <div class="order-list">
                                                <div class="list-item">
                                                    <div class="item-title">Product</div>
                                                    <div class="subtotal">Subtotal</div>
                                                </div>
                                               
                                                @foreach ($cart as $item)

                                                    <div class="product-item">
                                                        <div class="product-name">{{ $item['product']->name }} -
                                                            {{ $item['size']->size }}
                                                            <span>x{{ $item['quantity'] }}</span>
                                                        </div>
                                                        <div class="product-total">
                                                            {{ $item['size']->price * $item['quantity'] }} SAR</div>
                                                    </div>
                                                @endforeach

                                                <div class="list-item">
                                                    <div class="subtotal">Subtotal</div>
                                                    <div class="product-total">{{ $totalPrice }} SAR</div>
                                                </div>
                                                <div class="list-item">
                                                    <div class="shipping">Shipping</div>
                                                    <div class="shipping-total">30 SAR</div>
                                                </div>

                                                <div class="list-item">
                                                    <div class="total">Total</div>
                                                    <div class="product-total">{{ $totalPrice + 30 }} SAR</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-method-wrapper">
                                            <h4 class="title mb-5">Payments Method</h4>
                                            <ul id="paymentMethod" class="mb-10">
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="cash_on_delivery" id="method3" checked>
                                                    <label class="form-check-label" for="method3"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse2">Cash On
                                                        Delivery</label>
                                                </li>
                                            </ul>
                                            <button class="theme-btn style-one">Place Order</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function addressSelection() {
            return {
                selectedAddress: '', // Initialize with an empty value
                showNewAddressForm: false, // Default to not showing new address form
                handleAddressChange() {
                    // Only show new address form if "new" is selected
                    if (this.selectedAddress === 'new') {
                        this.showNewAddressForm = true;
                    } else {
                        this.showNewAddressForm = false;
                    }
                }
            };
        }
    </script>
</x-layout>
