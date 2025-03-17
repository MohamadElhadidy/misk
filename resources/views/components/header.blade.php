<div>
    <header class="header-area">
        <!--===  Search Header Main  ===-->
        <div class="search-header-main">
            <div class="container">
                <!--===  Search Header Inner  ===-->
                <div class="search-header-inner">
                    <!--=== Site Branding  ===-->
                    <div class="site-branding">
                        <a href="/" class="brand-logo"><img src="{{$settings->get('store_logo')}}"
                                alt="Logo"></a>
                    </div>
                    <!--===  Product Search Category  ===-->
                    <div class="product-search-category">

                        <form class="w-full mx-auto">
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Products..." required />
                            </div>
                        </form>

                    </div>
                    <!--===  Hotline Support  ===-->
                    <div class="hotline-support item-rtl">
                        <div class="icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="info">
                            <span>24/7 Support</span>
                            <h5><a href="tel:{{$settings->get('store_phone')}}" dir="ltr">{{$settings->get('store_phone')}}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===  Header Navigation  ===-->
        <div class="header-navigation style-one">
            <div class="container">
                <!--=== Primary Menu ===-->
                <div class="primary-menu">
                    <div class="site-branding d-lg-none d-block">
                        <a href="index.html" class="brand-logo"><img src="/assets/images/logo/logo-main.png"
                                alt="Logo"></a>
                    </div>
                    <!--=== Nav Inner Menu ===-->
                    <div class="nav-inner-menu">
                        <div class="pesco-nav-main">
                            <!--=== Pesco Nav Menu ===-->
                            <div class="pesco-nav-menu">
                                <!--=== Responsive Menu Search ===-->
                                <div class="nav-search mb-40 d-block d-lg-none">
                                    <div class="form-group">
                                        <input type="search" class="form_control" placeholder="Search Here"
                                            name="search">
                                        <button class="search-btn"><i class="far fa-search"></i></button>
                                    </div>
                                </div>
                                <!--=== Responsive Menu Tab ===-->
                                <div class="pesco-tabs style-three d-block d-lg-none">
                                    <ul class="nav nav-tabs mb-30" role="tablist">
                                        <li>
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav1"
                                                role="tab">Menu</button>
                                        </li>
                                        <li>
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav2"
                                                role="tab">Category</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav1">
                                            <nav class="main-menu">
                                                <ul>
                                                    <li class="menu-item has-children"><a href="#">Home</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="index.html">Home 01</a></li>
                                                            <li><a href="index-2.html">Home 02</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item has-children"><a href="#">Shop</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="shops-grid.html">Shop Grid</a></li>
                                                            <li><a href="shops.html">Shop left Sidebar</a></li>
                                                            <li><a href="shops-right-sidebar.html">Shop Right
                                                                    Sidebar</a>
                                                            </li>
                                                            <li><a href="shop-details.html">Product Details</a></li>
                                                            <li><a href="cart.html">Cart</a></li>
                                                            <li><a href="checkout.html">Checkout</a></li>
                                                            <li><a href="wishlists.html">Wishlist</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item has-children"><a href="#">Blog</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="blogs.html">Our Blog</a></li>
                                                            <li><a href="blog-details.html">Blog Details</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item has-children"><a href="#">Pages</a>
                                                        <ul class="sub-menu">
                                                            <li><a href="about-us.html">About Us</a></li>
                                                            <li><a href="faq.html">Faqs</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item"><a href="contact.html">Contact</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="tab-pane fade" id="nav2">
                                            <div class="categori-dropdown-item">
                                                <ul>
                                                    <li>
                                                        <a href="shops.html"> <img src="/assets/images/icon/shirt.png"
                                                                alt="Shirts">Man Shirts</a>
                                                    </li>
                                                    <li>
                                                        <a href="shops.html"> <img src="/assets/images/icon/denim.png"
                                                                alt="Jeans">Denim Jeans</a>
                                                    </li>
                                                    <li>
                                                        <a href="shops.html"> <img src="/assets/images/icon/suit.png"
                                                                alt="Suit">Casual Suit</a>
                                                    </li>
                                                    <li>
                                                        <a href="shops.html"> <img src="/assets/images/icon/dress.png"
                                                                alt="Dress">Summer Dress</a>
                                                    </li>
                                                    <li>
                                                        <a href="shops.html"> <img
                                                                src="/assets/images/icon/sweaters.png"
                                                                alt="Sweaters">Sweaters</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--===  Hotline Support  ===-->
                                <div class="hotline-support d-flex d-lg-none mt-30">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="info">
                                        <span>24/7 Support</span>
                                        <h5><a href="tel:+941234567894">+94 123 4567 894</a></h5>
                                    </div>
                                </div>
                                <!--=== Main Menu ===-->
                                <nav class="main-menu d-none d-lg-block">
                                    <ul>
                                        <li class="menu-item"><a href="/">Home</a></li>

                                        <li class="menu-item has-children"><a href="#">Categories</a>
                                            <ul class="sub-menu">
                                                <li><a href="shops-grid.html">Shop Grid</a></li>
                                                <li><a href="shops.html">Shop left Sidebar</a></li>
                                                <li><a href="shops-right-sidebar.html">Shop Right Sidebar</a></li>
                                                <li><a href="shop-details.html">Product Details</a></li>
                                                <li><a href="cart.html">Cart</a></li>
                                                <li><a href="checkout.html">Checkout</a></li>
                                                <li><a href="wishlists.html">Wishlist</a></li>
                                            </ul>
                                        </li>

                                        <li class="menu-item"><a href="/about">About Us</a></li>
                                        <li class="menu-item"><a href="/contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <!--=== Nav Right Item ===-->
                    <div class="nav-right-item style-one">
                        <ul>
                            @php
                                $wishlist = auth()->check()
                                    ? auth()->user()->wishlist()->count()
                                    : count(session('wishlist') ?? []);

                                $cart = auth()->check() ? auth()->user()->cart()->get()  : session('cart') ?? [];


                                $totalQuantity = 0;
                                foreach ($cart as $productSizes) {
                                    if (auth()->check()) {
                                        $totalQuantity += $productSizes->quantity;
                                    } else {
                                        foreach ($productSizes as $item) {
                                            $totalQuantity += (int) $item['quantity'];
                                        }
                                    }
                                }

                            @endphp
                            <li>
                                <a href="/wishlist" class="wishlist-btn d-lg-block d-none"><i
                                        class="far fa-heart"></i><span
                                        class="pro-count">{{ $wishlist }}</span></a>

                            </li>
                            <li>
                                <a href="/cart" class="cart-button d-flex align-items-center">
                                    <div class="icon">
                                        <i class="fas fa-shopping-bag"></i><span
                                            class="pro-count">{{ $totalQuantity }}</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="deals d-lg-block d-none">
                            @guest
                                        <a href="/login" target="_blank"
                                           class="rounded-md bg-black px-3 py-2 text-sm  text-gray-200 shadow-xs hover:bg-gray-800 focus-visible:outline-2 ">Login</a>
                            @else
                                        @admin
                                        <a href="{{ route('admin') }}" target="_blank"
                                           class="rounded-md bg-black px-3 py-2 text-sm  text-gray-200 shadow-xs hover:bg-gray-800 focus-visible:outline-2 ">Admin</a>
                                       @else
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="hover:text-[#cc0d39] transition-all duration-300 ease-out rounded-md bg-black px-3 py-2 text-sm  text-gray-200 shadow-xs hover:bg-gray-800 focus-visible:outline-2 ">
                                                Logout</button>
                                        </form>
                                        @endadmin





                            @endguest
                                </div>
                            </li>

                        </ul>
                        <div class="navbar-toggler d-block d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

</div>
