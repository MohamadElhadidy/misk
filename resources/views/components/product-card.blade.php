<div class="product-item style-three" data-aos="fade-up" data-aos-duration="1100">
    <div class="product-thumbnail">
        <img class="" src="{{ '/storage/' . $product->images->first()?->path }}" alt="Products">
        {{-- <div class="discount">20% Off</div> --}}

        @php

            $isInWishlist = auth()->check()
                ? auth()->user()->wishlist()->where('product_id', $product->id)->exists()
                : in_array($product->id, session('wishlist') ?? []);

        @endphp


        <div class="hover-content">

            <form action="/wishlist" method="post" id="Wishlist{{ $product->id }}">
                @csrf
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                @auth
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                @endauth
            </form>




            <a  class="cart-btn cursor-pointer  {{ $isInWishlist ? '!bg-red-600 text-white !border-none' : '' }}" id="WishlistLink{{ $product->id }}"><i
                    class="far fa-heart"></i></a>
            {{-- <a href="#" class="cart-btn"><i class="far fa-shopping-basket"></i></a> --}}
            <a href="/products/{{ $product->id }}" class="icon-btn"><i class="fa fa-eye"></i></a>
        </div>
    </div>
    @php
        $sizes = $product->sizes()->orderBy('price')->get();
    @endphp
    <div class="product-info-wrap">
        <div class="product-info">
            <div class="product-meta d-flex">
                <span><a href="/categories/{{ $product->category->id }}">{{ $product->category->name }}</a></span>
                {{-- <ul class="ratings rating4">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                    </ul> --}}
            </div>
            <h4 class="title"><a href="/products/{{ $product->id }}">{{ $product->name }}
                </a></h4>
        </div>
        <div class="product-price">

            <span class="price new-price">{{ $sizes->first()->price }} <span class="currency">SAR</span></span>
            @if ($sizes->first()->price != $sizes->last()->price)
                <span class="price new-price">-</span>
                <span class="price new-price">{{ $sizes->last()->price }} <span class="currency">SAR</span></span>
            @endif
            {{-- <span class="price prev-price"><span class="currency">$</span>{{$sizes->last()->price}}</span> --}}
        </div>
    </div>


    <script>
        document.getElementById('WishlistLink{{ $product->id }}').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            document.getElementById('Wishlist{{ $product->id }}').submit(); // Submit the form
        });
    </script>



</div>
