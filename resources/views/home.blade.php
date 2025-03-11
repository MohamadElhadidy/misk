<x-layout>

    <main class="main-bg">
        <!--====== Start Hero Section ======-->
        <section class="hero-section">
            <!--=== Hero Wrapper ===-->
            <div class="hero-wrapper-two">
                <!--=== Hero shape ===-->
                <div class="hero-shape bg_cover d-none d-xl-block" style="background-image: url(assets/images/hero/hero-two-shape1.png);"></div>
                <!--=== Hero Image ===-->
                <div class="hero-image d-none d-xl-block">
                    <img src="assets/images/hero/hero-two_img1.jpg" alt="Hero Image">
                    <div class="hero-img-shape"><img src="assets/images/hero/hero-two-img-shape1.png" alt="Image Shape"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <!--=== hero Post Slider ===-->
                            <div class="hero-post-slider mb-100">
                                <!--=== Single Post Slider ===-->
                                <div class="single-hero-post">
                                    <div class="hero-content style-two">
                                        <span class="tag-line"><i class="flaticon-star-2"></i><b>Best for your categories</b><i class="flaticon-star-2"></i></span>
                                        <h1><span>Get 20% Off</span> Women Cloth Collections</h1>
                                        <p>Enjoy 20% off on our entire Women’s Clothing Collection! Discover stylish outfits for every occasion and save on your favorite pieces. </p>
                                        <a href="shops.html" class="theme-btn style-one">Shop Now</a>
                                    </div>
                                </div>
                                <!--=== Single Post Slider ===-->
                                <div class="single-hero-post">
                                    <div class="hero-content style-two">
                                        <span class="tag-line"><i class="flaticon-star-2"></i><b>Best for your categories</b><i class="flaticon-star-2"></i></span>
                                        <h1><span>Get 20% Off</span> Women Cloth Collections</h1>
                                        <p>Enjoy 20% off on our entire Women’s Clothing Collection! Discover stylish outfits for every occasion and save on your favorite pieces. </p>
                                        <a href="shops.html" class="theme-btn style-one">Shop Now</a>
                                    </div>
                                </div>
                                <!--=== Single Post Slider ===-->
                                <div class="single-hero-post">
                                    <div class="hero-content style-two">
                                        <span class="tag-line"><i class="flaticon-star-2"></i><b>Best for your categories</b><i class="flaticon-star-2"></i></span>
                                        <h1><span>Get 20% Off</span> Women Cloth Collections</h1>
                                        <p>Enjoy 20% off on our entire Women’s Clothing Collection! Discover stylish outfits for every occasion and save on your favorite pieces. </p>
                                        <a href="shops.html" class="theme-btn style-one">Shop Now</a>
                                    </div>
                                </div>
                                <!--=== Single Post Slider ===-->
                                <div class="single-hero-post">
                                    <div class="hero-content style-two">
                                        <span class="tag-line"><i class="flaticon-star-2"></i><b>Best for your categories</b><i class="flaticon-star-2"></i></span>
                                        <h1><span>Get 20% Off</span> Women Cloth Collections</h1>
                                        <p>Enjoy 20% off on our entire Women’s Clothing Collection! Discover stylish outfits for every occasion and save on your favorite pieces. </p>
                                        <a href="shops.html" class="theme-btn style-one">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                            <!--=== Hero Dots ===-->
                            <div class="hero-dots text-center text-xl-start"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--====== End Hero Section ======-->
        <!--====== End Hero Section ======-->
        <!--===== Start Banner Section  ======-->
        <!--===== Start Category Section  ======-->
        <section class="category-section pt-90 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--=== Section Title  ===-->
                        <div class="section-title  text-center text-md-start mb-50" data-aos="fade-right"
                            data-aos-delay="10" data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">Categories</span>
                            </div>
                            <h2>Browse Top Category</h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--=== Category Button  ===-->
                        <div class="category-button text-center float-md-end mb-60" data-aos="fade-left"
                            data-aos-delay="15" data-aos-duration="1200">
                            <a href="shops.html" class="theme-btn style-one">View All <i
                                    class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!--====== Start Category Wrapper ======-->
                <div class="category-wrapper">
                    <div class="row justify-content-center">

                        @foreach ($categories as $category)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                <!--=== Category Item  ===-->
                                <div class="category-item style-two mb-110" data-aos="fade-up" data-aos-delay="10"
                                    data-aos-duration="800">
                                    <a href='/' class="category-img">
                                        <img src="{{ '/storage/' . $category->image }}" alt="Category Thumbnail">
                                    </a>
                                    <div class="category-content">
                                        <a href='/' class="category-btn">{{ $category->name }}</a>
                                        {{-- <span>10 items</span> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <!--===== End Category Section  ======-->


        <!--===== Start Features Section  ======-->
        <section class="features-products-section pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Section Title  ===-->
                        <div class="section-title text-center mb-20" data-aos="fade-up" data-aos-delay="10"
                            data-aos-duration="800">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">Feature Products</span>
                                <i class="flaticon-sparkler"></i>
                            </div>
                            <h2>Our Features Collection</h2>
                        </div>
                    </div>
                </div>
                <div class="products-item-wrapper">
                    <!--=== Product Item  ===-->
                    @foreach ($featured as $product)
                        <x-product-card :product="$product" />
                    @endforeach

                </div>
            </div>
        </section>
        <!--===== End Features Section  ======-->
        <!--===== Start Week Deal Section  ======-->
        <section class="week-deal-section">
            <div class="week-deal-wrapper overflow-hidden pt-130 pb-100">
                <div class="shape svg-shape1"><img src="assets/images/banner/week-svg.svg" alt="svg shape"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5">
                            <!--=== Week Deals Content ===-->
                            <div class="week-deals-box mb-30" data-aos="fade-right" data-aos-delay="10"
                                data-aos-duration="1000">
                                <span class="sub-heading"><i class="fas fa-tags"></i>Deal of the Week</span>
                                <h2>UP TO 80% OFF</h2>
                                <p>Don't miss out on our biggest sale! Enjoy up to 80% off on a wide range of products.
                                </p>
                                <div class="week-deals-countdown mb-30">
                                    <h5>Hurry Up! Offer ends in. </h5>
                                    <div class="simply-countdown-two"></div>
                                </div>
                                <div class="shop-button">
                                    <a href="shops.html" class="theme-btn style-one">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7">
                            <!--=== Week Top Product Slider ===-->
                            <div class="weekly-top-product-slider" data-aos="fade-up" data-aos-delay="15"
                                data-aos-duration="1200">
                                <!--=== Product Item ===-->
                                <div class="product-item style-five mb-30">
                                    <div class="product-thumbnail">
                                        <img src="assets/images/products/product-5.png" alt="product Thumbnail">
                                        <div class="hover-content">
                                            <div class="product-info">
                                                <h4 class="title"><a href="shop-details.html">Women’s Georgette
                                                        Traditional Stunning Outfit</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--=== Product Item ===-->
                                <div class="product-item style-five mb-30">
                                    <div class="product-thumbnail">
                                        <img src="assets/images/products/product-6.png" alt="product Thumbnail">
                                        <div class="hover-content">
                                            <div class="product-info">
                                                <h4 class="title"><a href="shop-details.html">Women’s Georgette
                                                        Traditional Stunning Outfit</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--=== Product Item ===-->
                                <div class="product-item style-five mb-30">
                                    <div class="product-thumbnail">
                                        <img src="assets/images/products/product-7.png" alt="product Thumbnail">
                                        <div class="hover-content">
                                            <div class="product-info">
                                                <h4 class="title"><a href="shop-details.html">Women’s Georgette
                                                        Traditional Stunning Outfit</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!--===== End Week Deal Section  ======-->
        <!--===== Start Shop Products Section  ======-->
        <section class="shop-products-section pt-125">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!--=== Section Title  ===-->
                        <div class="section-title text-center text-lg-start mb-14" data-aos="fade-right"
                            data-aos-duration="1000">
                            <div class="sub-heading d-inline-flex align-items-center">
                                <i class="flaticon-sparkler"></i>
                                <span class="sub-title">Shop Prodcucts</span>
                            </div>
                            <h2>Our Shop all Products</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--=== Pesco Tabs ===-->
                        <div class="pesco-tabs style-one mb-50" data-aos="fade-left" data-aos-duration="1200">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a href='#' class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#cat1">See More</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--=== Tab Content ===-->
                        <div class="tab-content" data-aos="fade-up" data-aos-duration="1400">
                            <!--=== Tab Pane  ===-->
                            <div class="tab-pane fade show active" id="cat1">
                                <!--=== Product Item Wrapper  ===-->
                                <div class="products-item-wrapper">
                                    <!--=== Product Item  ===-->
                                    @foreach ($products as $product)
                                        <x-product-card :product="$product" />
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== Start Newsletter Section ======-->
        <section class="newsletter-section  pt-110 pb-10">
            <div class="newsletter-wrapper-two p-r z-1 pt-20 pb-10">
                <div class="newsletter-image-two" data-aos="fade-left" data-aos-duration="1200"><img
                        src="assets/images/newsletter/newsletter-2.jpg" alt="newsletter image"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="section-content-box" data-aos="fade-up" data-aos-duration="1000">
                                <!--=== Section Title  ===-->
                                <div class="section-title">
                                    <div class="sub-heading d-inline-flex align-items-center">
                                        <i class="flaticon-sparkler"></i>
                                        <span class="sub-title">Our Blogs</span>
                                    </div>
                                    <h2>Subscribe <span>newsletter</span> <br> to & get Every day discount</h2>
                                </div>
                                <form>
                                    <input type="email" class="form_control" placeholder="Write your Email Address"
                                        name="email" required>
                                    <button class="theme-btn style-one">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--====== End Newsletter Section ======-->
        <!--====== Start Features Section ======-->
        <section class="features-section pt-10 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item style-three mb-25" data-aos="fade-up" data-aos-duration="800">
                            <div class="icon">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div class="content">
                                <h5>Free Shipping</h5>
                                <p>You get your items delivered without any extra cost.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item style-three mb-25" data-aos="fade-up" data-aos-duration="1000">
                            <div class="icon">
                                <i class="fas fa-microphone"></i>
                            </div>
                            <div class="content">
                                <h5>Great Support 24/7</h5>
                                <p>Our customer support team is available around the clock </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item style-three mb-25" data-aos="fade-up" data-aos-duration="1200">
                            <div class="icon">
                                <i class="far fa-handshake"></i>
                            </div>
                            <div class="content">
                                <h5>Return Available</h5>
                                <p>Making it easy to return any items if you're not satisfied.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <!--=== Iconic Box Item ===-->
                        <div class="iconic-box-item style-three mb-25" data-aos="fade-up" data-aos-duration="1400">
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
        </section><!--====== End Features Section ======-->
    </main>
</x-layout>
