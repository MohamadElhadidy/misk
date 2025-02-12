<x-layout>
    <main class="main-bg">

        <!--====== Start Cart Section ======-->
        <section class="wishlist-page-section pt-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <!--=== Cart Wrapper ===-->
                        <div class="cart-wrapper" data-aos="fade-up" data-aos-delay="20" data-aos-duration="1000">
                            <!--=== Cart List ===-->
                            <div class="cart-list table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-tshirt"></i>Products Details</th>
                                            <th><i class="fas fa-sack-dollar"></i>Price</th>
                                            {{-- <th><i class="fas fa-eye"></i>Stock Status</th> --}}
                                            <th><i class="fas fa-rocket-launch"></i>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlist as $product)
                                            <tr>
                                                <td>
                                                    <div class="product-thumb-item">
                                                        <div class="product-img">
                                                            <img src="{{ '/storage/' . $product->images->first()?->path }}"
                                                                alt="Product Thumbnail">
                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="title"><a
                                                                    href="/products/{{ $product->id }}">{{ $product->name }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        $sizes = $product->sizes()->orderBy('price')->get();
                                                    @endphp




                                                    <div class="price"> <span
                                                            class="price new-price">{{ $sizes->first()->price }} <span
                                                                class="currency">{{ config('app.currency') }}</span></span>
                                                        @if ($sizes->first()->price != $sizes->last()->price)
                                                            <span class="price new-price">-</span>
                                                            <span class="price new-price">{{ $sizes->last()->price }}
                                                                <span class="currency">{{ config('app.currency') }}</span></span>
                                                        @endif
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <div class="product-stock">24 in stock</div>
                                                </td> --}}
                                                <td>
                                                    <div class="action-cart">
                                                        {{-- <div class="quantity-input">
                                                            <button class="quantity-down"><i
                                                                    class="far fa-minus"></i></button>
                                                            <input class="quantity" type="text" value="1"
                                                                name="quantity">
                                                            <button class="quantity-up"><i
                                                                    class="far fa-plus"></i></button>
                                                        </div> --}}
                                                        <div class="cart-remove">
                                                            <form action="{{ route('wishlist.destroy') }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <button type="submit"><i class="far fa-times"></i></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Cart Section ======-->
        <!--====== Start Features Section ======-->
        <section class="features-section pt-115 pb-130">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Features Wrapper ===-->
                        <div class="features-wrapper" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1000">
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="content">
                                    <h5>Free Shipping</h5>
                                    <p>You get your items delivered without any extra cost.</p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="assets/images/divider.png" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-microphone"></i>
                                </div>
                                <div class="content">
                                    <h5>Great Support 24/7</h5>
                                    <p>Our customer support team is available around the clock </p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="assets/images/divider.png" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="far fa-handshake"></i>
                                </div>
                                <div class="content">
                                    <h5>Return Available</h5>
                                    <p>Making it easy to return any items if you're not satisfied.</p>
                                </div>
                            </div>
                            <!--=== Divider ===-->
                            <div class="divider mb-25">
                                <img src="assets/images/divider.png" alt="divider">
                            </div>
                            <!--=== Iconic Box Item ===-->
                            <div class="iconic-box-item icon-left-box mb-25">
                                <div class="icon">
                                    <i class="fas fa-sack-dollar"></i>
                                </div>
                                <div class="content">
                                    <h5>Secure Payment</h5>
                                    <p>Shop with confidence knowing that our secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Features Section ======-->
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
