<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.5/dist/cdn.min.js" defer></script>

    <main class="main-bg">
        <section class="checkout-section pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="checkout-wrapper" data-aos="fade-up" data-aos-duration="1200">
                            <form class="checkout-form" method="POST" action="/checkout">
                                @csrf
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
                                                            @foreach (auth()->user()->addresses() as $address)
                                                                <option value="{{ $address->id }}">
                                                                    {{ $address->country }}</option>
                                                            @endforeach
                                                            <option value="new">Add
                                                                new address</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <!-- New Address Form -->
                                                <div x-show="showNewAddressForm" x-transition class="mt-10">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Country / Region<span>*</span></label>
                                                            <select class="wide" id="country">
                                                                <option>United States</option>
                                                                <option>England</option>
                                                                <option>New Zealand</option>
                                                                <option>Switzerland</option>
                                                                <option>Germany</option>
                                                                <option>Sweden</option>
                                                                <option>Canada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Postcode / Zip <span>*</span></label>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex:  WC2N 5DU" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Town / City <span>*</span></label>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex: London" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form_group">
                                                            <label>Street address<span>*</span></label>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex:  123 Elm Street" required>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex:  123 Elm Street" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form_group">
                                                            <label>Phone Number <span>*</span></label>
                                                            <input type="text" class="form_control"
                                                                placeholder="Ex: +1 (555) 123-4567" name="phone"
                                                                required>
                                                        </div>
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
                                                        name="flexRadioDefault" id="method3" checked>
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
