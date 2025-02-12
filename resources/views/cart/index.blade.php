<x-layout>

    <main class="main-bg">

        <!--====== Start Cart Section ======-->
        <section class="cart-page-section pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="cart-wrapper mb-40" data-aos="fade-up" data-aos-duration="1200">
                            <h3 class="mb-20">Total Cart Item: {{ $totalQuantity }}</h3>
                            <div class="cart-list table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-tshirt"></i>Products Details</th>
                                            <th><i class="fas fa-sack-dollar"></i>Price</th>
                                            <th style="text-align: center;"><i class="fas fa-eye"></i>Quantity</th>
                                            <th style="text-align: right;"><i class="fas fa-money-bill"></i>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>
                                                    <div class="product-thumb-item">
                                                        <div class="product-img">
                                                            <img src="{{ '/storage/' . $item['product']->images->first()?->path }}"
                                                                alt="Product Thumbnail">
                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="title"><a
                                                                    href="/products/{{ $item['product']->id }}">{{ $item['product']->name }}</a>
                                                            </h4>
                                                            <div class="product-meta">
                                                                <span>{{ $item['size']->size }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price">{{ $item['size']->price }} {{ config('app.currency') }}</div>
                                                </td>
                                                <td>
                                                    <div class="action-cart">
                                                        <div class="quantity-input">

                                                            <button type="button" class="quantity-down"><i
                                                                    class="far fa-minus"></i></button>
                                                            <form action="/cart/update" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="productId"
                                                                       value="{{ $item['product']->id }}">
                                                                <input type="hidden" name="sizeId"
                                                                       value="{{ $item['size']->id }}">
                                                            <input class="quantity" class="!w-auto" type="text"
                                                                value="{{ $item['quantity'] }}" name="quantity" onchange="this.form.submit()">
                                                            </form>
                                                            <button type="button" class="quantity-up"><i
                                                                    class="far fa-plus"></i></button>

                                                        </div>
                                                        <div class="cart-remove">
                                                            <form action="{{ route('cart.destroy') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="productId"
                                                                    value="{{ $item['product']->id }}">
                                                                <input type="hidden" name="sizeId"
                                                                    value="{{ $item['size']->id }}">

                                                                <button type="submit"><i
                                                                        class="far fa-times"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="total-price">
                                                        {{ $item['size']->price * $item['quantity'] }} {{ config('app.currency') }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-bottom d-flex align-items-center justify-content-between mt-40">
                                <div class="ct-shopping">
                                    <a href="/shop" class="theme-btn style-one">Continue Shopping</a>

                                </div>
                                @if ($totalPrice != 0)
                                <div class="cl-cart">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="theme-btn style-one">Clear Cart</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <!--=== Cart Sidebar Area  ===-->
                        <div class="cart-sidebar-area">
                            <!--=== Cart Widget  ===-->
                            <!--=== Cart Widget  ===-->
                            @if ($totalPrice != 0)
                                <div class="cart-widget cart-total-widget mt-60 mb-40" data-aos="fade-up"
                                    data-aos-duration="1400">
                                    <h4>Cart Totals</h4>
                                    <div class="sub-total">
                                        <h5>Subtotal <span class="price">{{ $totalPrice }} {{ config('app.currency') }}</span></h5>
                                    </div>
                                    <div class="shipping-cart">
                                        <h4>Shipping</h4>
                                        <div class="single-radio">
                                            <input class="form-check-input" type="radio" name="radio" checked
                                                value="Slim Fit" id="radio1">
                                            <label class="form-check-label" for="radio1">
                                                Delivery <span class="price">30 {{ config('app.currency') }}</span>
                                            </label>
                                        </div>
                                        {{-- <div class="single-radio">
                                            <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="radio2">
                                            <label class="form-check-label" for="radio1">
                                                Flat Rate <span class="price">$890.00</span>
                                            </label>
                                        </div>
                                        <div class="single-radio">
                                            <input class="form-check-input" type="radio" name="radio" value="Slim Fit" id="radio3">
                                            <label class="form-check-label" for="radio3">
                                                Local Area <span class="price">$890.00</span>
                                            </label>
                                        </div> --}}
                                    </div>
                                    <div class="price-total">
                                        <h5>Total <span class="price">{{ $totalPrice + 30 }} {{ config('app.currency') }}</span></h5>
                                    </div>
                                    <div class="proceced-checkout">
                                        <a href="/checkout" class="theme-btn style-one">Proceed to checkout</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Cart Section ======-->
        <!--====== Start Newsletter Sections  ======-->
        <section class="newsletter-section pb-95">
            <div class="container">
                <!--=== Newsletter Wrapper  ===-->
                <div class="newsletter-wrapper white-bg p-r z-1" data-aos="fade-up" data-aos-duration="1000">
                    <div class="newsletter-shape pattern-one"><span><img src="assets/images/newsletter/pattern-1.png"
                                alt="Pattern Shape"></span></div>
                    <div class="newsletter-shape pattern-two"><span><img src="assets/images/newsletter/pattern-2.png"
                                alt="Pattern Shape"></span></div>
                    <div class="newsletter-shape shape-one"><span><img src="assets/images/newsletter/shape-1.png"
                                alt="Shape"></span></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="newsletter-content-box">
                                <span class="sub-text">Our Newsletter</span>
                                <h3>Get weekly update. Sign up and get up to <span>20% off</span> your first purchase
                                </h3>
                                <form>
                                    <div class="form-group">
                                        <input type="email" class="form_control"
                                            placeholder="Write your Email Address" name="email">
                                        <button class="theme-btn style-one">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="newsletter-image">
                                <img src="assets/images/newsletter/newsletter-1.png" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Newsletter Sections  ======-->
    </main>
</x-layout>
