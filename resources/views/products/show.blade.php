<x-layout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta name="_token" content="{{ csrf_token() }}">
    <main class="main-bg">
        <!--====== Start Shop Details Section ======-->
        <section class="shop-details-section pt-20 pb-40">
            <div class="container">
                <div class="shop-details-wrapper">
                    <div class="row">
                        <div class="col-xl-6">
                            <!--=== Product Gallery ===-->
                            <div class="product-gallery-area mb-50" data-aos="fade-up" data-aos-duration="1200">
                                <div class="product-big-slider mb-30 justify-center flex">
                                    @foreach ($product->images as $image)
                                        <div class="product-img">
                                            <a href="assets/images/products/product-big-1.jpg" class="img-popup"><img
                                                    src="{{ '/storage/' . $image->path }}" alt="Product"></a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="product-thumb-slider">
                                    @foreach ($product->images as $image)
                                        <div class="product-img">
                                            <a href="assets/images/products/product-big-1.jpg" class="img-popup"><img
                                                    src="{{ '/storage/' . $image->path }}" alt="Product"></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="product-info mb-50" data-aos="fade-up" data-aos-duration="1400"
                                x-data="productData({{ $product->sizes }})">
                                {{-- <span class="sale"><i class="fas fa-tags"></i>SALE 70% OFF</span> --}}
                                <h4 class="title">{{ $product->name }}</h4>
                                {{-- <ul class="ratings rating5">
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><i class="fas fa-star"></i></li>
                                    <li><a href="#">(45 Reviews)</a></li>
                                </ul> --}}
                                <p>{!! $product->description !!}</p>


                                <!-- Product Price -->
                                <div class="product-price">
                                    {{-- <span class="price prev-price"><span class="currency">$</span>70.00</span> --}}
                                    <span class="price new-price">

                                        <span x-text="selectedPrice ? selectedPrice : sizes[0].price"></span>
                                        <span class="currency">{{ config('app.currency') }}</span>
                                    </span>
                                </div>
                                {{-- <div class="product-color">
                                    <h4 class="mb-15">Color</h4>
                                    <ul class="color-list mb-20">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    value="black" id="color1">
                                                <label class="form-check-label" for="color1">
                                                    <span class="color1"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    value="red" id="color2">
                                                <label class="form-check-label" for="color2">
                                                    <span class="color2"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    value="blue" id="color3">
                                                <label class="form-check-label" for="color3">
                                                    <span class="color3"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="radio"
                                                    value="blue" id="color4">
                                                <label class="form-check-label" for="color4">
                                                    <span class="color4"></span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div> --}}
                                <div class="product-size">
                                    <h4 class="mb-15">Size</h4>
                                    <ul class="size-list mb-30">
                                        <template x-for="size in sizes" :key="size.id">
                                            <li>
                                                {{-- <input class="form-check-input" type="radio" name="size"
                                                        :value="size" x-model="selectedSize"
                                                        :id="'size' + size.id"> --}}


                                                <div class="form-check">
                                                    {{-- <input class="form-check-input" type="radio" name="radio"
                                                        value="Slim Fit" id="size2"> --}}

                                                    <input class="form-check-input" type="radio"
                                                        :value="size.size" @click="updatePrice(size)"
                                                        :id="'size' + size.id" x-model="selectedSize">
                                                    <label class="form-check-label" :for="'size' + size.id"
                                                        x-text="size.size">
                                                    </label>
                                                </div>
                                            </li>
                                        </template>

                                    </ul>
                                </div>


                                <div class="product-cart-variation">
                                    <ul x-data="{ quantity: 1 }">


                                        <li >
                                            <div class="quantity-input">
                                                <button type="button" class="quantity-down"
                                                    @click="if (quantity > 1) quantity--"><i
                                                        class="far fa-minus"></i></button>
                                                <input class="quantity" type="text" :value="quantity"
                                                    x-model="quantity" >
                                                <button type="button" class="quantity-up" @click="quantity++"><i
                                                        class="far fa-plus"></i></button>
                                            </div>
                                        </li>
                                        <li>
                                            <form action="{{ route('cart.add', [$product->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="sizeId" :value="selectedID">
                                                <input type="hidden" name="quantity" :value="quantity">
                                                <button type="submit" class="theme-btn style-one">Add To cart</button>
                                            </form>
                                        </li>


                                        @php

                                            $isInWishlist = auth()->check()
                                                ? auth()
                                                    ->user()
                                                    ->wishlist()
                                                    ->where('product_id', $product->id)
                                                    ->exists()
                                                : in_array($product->id, session('wishlist') ?? []);

                                        @endphp

                                        <li class="flex space-x-4 flex-wrap items-center">
                                            <form action="/wishlist" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                @auth
                                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                                @endauth
                                                <button type="submit"
                                                    class="icon-btn {{ $isInWishlist ? '!bg-red-600 text-white !border-none' : '' }}"><i
                                                        class="far fa-heart"></i></button>
                                            </form>
                                        </li>
                                        {{-- <li>
                                            <a href="shops.html" class="icon-btn"><i class="far fa-sync"></i></a>
                                        </li> --}}
                                    </ul>
                                </div>

                                <div class="product-meta">
                                    <ul>
                                        {{-- <li><span>SKU :</span>KE-91039</li> --}}
                                        <li><span>Category :</span>{{ $product->category->name }}</li>
                                        {{-- <li><span>Tags :</span><a href="#">Bags</a>,<a
                                                href="#">Cloths</a>,<a href="#">Dress</a></li>
                                        <li><span>Share :</span>
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="special-features">
                                    <span><i class="far fa-shipping-fast"></i>Free Shipping</span>
                                    <span><i class="far fa-box-open"></i>Easy Returns</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="additional-information-wrapper" data-aos="fade-up" data-aos-delay="30"
                        data-aos-duration="1000">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="additional-info-box mb-40">
                                    <h3>Additional Information:</h3>
                                    <ul>
                                        <li>Fabric type <span>Georgette</span></li>
                                        <li>Care instructions:<span>Machine Wash</span></li>
                                        <li>Occasion type: <span>Casual</span></li>
                                        <li>Sleeve type: <span>Long Sleeve</span></li>
                                        <li>Pattern:<span>Solid</span></li>
                                        <li>Closure type: <span>Georgette</span></li>
                                        <li>Country of Origin<span>Bangladesh</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="description-wrapper mb-40">
                                    <div class="pesco-tabs style-two mb-50">
                                        <ul class="nav nav-tabs">
                                            <li>
                                                <button class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#description">Description</button>
                                            </li>
                                            <li>
                                                <button class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#reviews">Reviews</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="description">
                                            <h4>Description</h4>
                                            <p>Cargo shorts: Rugged, casual shorts with multiple pockets for utility,
                                                often in khaki or olive green.
                                                Sundress with drawstring: A breezy, summery dress with a flowy skirt,
                                                often made from light, patterned fabric. It has a drawstring waist for a
                                                comfortable, adjustable fit. Designed for practicality, cargo shorts
                                                boast numerous pockets on the legs and hips. everyday wear for someone
                                                who needs to carry a lot.</p>
                                            <h4>Features</h4>
                                            <ul class="list">
                                                <li>Function First</li>
                                                <li>Summer Breeze </li>
                                                <li>Casual and Rugged</li>
                                                <li>Possible Interpretations</li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="reviews">
                                            <div class="pesco-comment-area mb-80">
                                                <h4>Total Reviews (90)</h4>
                                                <ul>
                                                    <li class="comment">
                                                        <div class="pesco-reviews-item">
                                                            <div class="author-thumb-info">
                                                                <div class="author-thumb">
                                                                    <img src="assets/images/products/review-1.jpg"
                                                                        alt="Auhthor">
                                                                </div>
                                                                <div class="author-info">
                                                                    <h5>Amelia Rodriguez</h5>
                                                                    <div class="author-meta">
                                                                        <ul class="ratings">
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                        </ul>
                                                                        <span>20 March 2024</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="author-review-content">
                                                                <p>Men’s Slim Fit Dress Shirt is an excellent choice for
                                                                    those who value modern style and impeccable
                                                                    tailoring. Crafted from a high-quality blend of
                                                                    cotton and polyester, this shirt offers a smooth,
                                                                    wrinkle-resistant finish that stays crisp throughout
                                                                    the day.</p>
                                                            </div>
                                                            <a href="#" class="reply"><i
                                                                    class="fas fa-reply-all"></i>Reply</a>
                                                        </div>
                                                    </li>
                                                    <li class="comment">
                                                        <div class="pesco-reviews-item">
                                                            <div class="author-thumb-info">
                                                                <div class="author-thumb">
                                                                    <img src="assets/images/products/review-2.jpg"
                                                                        alt="Auhthor">
                                                                </div>
                                                                <div class="author-info">
                                                                    <h5>Amelia Rodriguez</h5>
                                                                    <div class="author-meta">
                                                                        <ul class="ratings">
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                        </ul>
                                                                        <span>20 March 2024</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="author-review-content">
                                                                <p>Men’s Slim Fit Dress Shirt is an excellent choice for
                                                                    those who value modern style and impeccable
                                                                    tailoring. Crafted from a high-quality blend of
                                                                    cotton and polyester, this shirt offers a smooth,
                                                                    wrinkle-resistant finish that stays crisp throughout
                                                                    the day.</p>
                                                            </div>
                                                            <a href="#" class="reply"><i
                                                                    class="fas fa-reply-all"></i>Reply</a>
                                                        </div>
                                                        <ul class="reviews-reply">
                                                            <li class="comment">
                                                                <div class="pesco-reviews-item">
                                                                    <div class="author-thumb-info">
                                                                        <div class="author-thumb">
                                                                            <img src="assets/images/products/review-3.jpg"
                                                                                alt="Auhthor">
                                                                        </div>
                                                                        <div class="author-info">
                                                                            <h5>Amelia Rodriguez</h5>
                                                                            <div class="author-meta">
                                                                                <ul class="ratings">
                                                                                    <li><i class="fas fa-star"></i>
                                                                                    </li>
                                                                                    <li><i class="fas fa-star"></i>
                                                                                    </li>
                                                                                    <li><i class="fas fa-star"></i>
                                                                                    </li>
                                                                                    <li><i class="fas fa-star"></i>
                                                                                    </li>
                                                                                    <li><i class="fas fa-star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                                <span>20 March 2024</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="author-review-content">
                                                                        <p>Men’s Slim Fit Dress Shirt is an excellent
                                                                            choice for those who value modern style and
                                                                            impeccable tailoring. Crafted from a
                                                                            high-quality blend of cotton and polyester,
                                                                            this shirt offers a smooth,
                                                                            wrinkle-resistant finish that stays crisp
                                                                            throughout the day.</p>
                                                                    </div>
                                                                    <a href="#" class="reply"><i
                                                                            class="fas fa-reply-all"></i>Reply</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="reviews-contact-area">
                                                <h4>Write Comment</h4>
                                                <ul class="ratings rating5 mb-40">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><a href="#">(10)</a></li>
                                                </ul>
                                                <form class="pesco-contact-form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Name"
                                                                    class="form_control" name="name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <input type="email" placeholder="Email"
                                                                    class="form_control" name="Email" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <textarea class="form_control" placeholder="Write Reviews" name="message" cols="5" rows="10"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <button class="theme-btn style-one">Submit
                                                                    Review</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section><!--====== End Shop Details Section ======-->
        <!--====== Related Product Section ======-->
        <section class="releted-product-section pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title ===-->
                        <div class="section-title mb-50" data-aos="fade-right" data-aos-delay="50"
                            data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">Releted Products</span>
                            </div>
                            <h2>Customers also purchased</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="releted-product-arrows style-one mb-50" data-aos="fade-left" data-aos-delay="70"
                            data-aos-duration="1300"></div>
                    </div>
                </div>
                <div class="releted-product-slider">
                    <!--=== Project Item  ===-->
                    @foreach ($featured as $product)
                       <x-product-card :product="$product" />
                    @endforeach

                </div>
            </div>
        </section><!--====== End Product Section ======-->
    </main>

    <script>
        function productData(sizes) {
            return {
                sizes: sizes,
                selectedID : sizes.length > 0 ? sizes[0].id : null,
                selectedSize: sizes.length > 0 ? sizes[0].size : null,
                selectedPrice: sizes.length > 0 ? sizes[0].price : null,
                updatePrice(size) {
                    this.selectedID = size.id
                    this.selectedSize = size.size
                    this.selectedPrice = size.price
                }
            };
        }
    </script>

</x-layout>
