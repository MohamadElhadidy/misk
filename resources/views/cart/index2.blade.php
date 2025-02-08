<x-layout>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <main class="main-bg" x-data="cartData()">
        <section class="cart-page-section pt-120 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="cart-wrapper mb-40" data-aos="fade-up" data-aos-duration="1200">
                            <h3 class="mb-20">Total Cart Item: <span x-text="totalQuantity"></span></h3>
                            <div class="cart-list table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Products Details</th>
                                            <th>Price</th>
                                            <th style="text-align: center;">Quantity</th>
                                            <th style="text-align: right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(item, index) in cart" :key="index">
                                            <tr>
                                                <td>
                                                    <div class="product-thumb-item">
                                                        <div class="product-img">
                                                            <img :src="'/storage/' + item.product.images[0]?.path" alt="Product Thumbnail">
                                                        </div>
                                                        <div class="product-info">
                                                            <h4 class="title">
                                                                <a :href="'/products/' + item.product.id" x-text="item.product.name"></a>
                                                            </h4>
                                                            <div class="product-meta">
                                                                <span x-text="item.size.size"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="price" x-text="item.size.price + ' SAR'"></div>
                                                </td>
                                                <td>
                                                    <div class="action-cart">
                                                        <div class="quantity-input">
                                                            <button @click="decreaseQuantity(index)"><i class="far fa-minus"></i></button>
                                                            <input class="quantity" type="text" x-model="item.quantity">
                                                            <button @click="increaseQuantity(index)"><i class="far fa-plus"></i></button>
                                                        </div>
                                                        <div class="cart-remove">
                                                            <button @click="removeFromCart(index)"><i class="far fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="total-price" x-text="(item.size.price * item.quantity) + ' SAR'"></div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-bottom d-flex align-items-center justify-content-between mt-40">
                                <button class="theme-btn style-one">Continue Shopping</button>
                                <button class="theme-btn style-one" @click="clearCart">Clear Cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="cart-sidebar-area">
                            <div class="cart-widget cart-total-widget mt-60 mb-40" data-aos="fade-up" data-aos-duration="1400">
                                <h4>Cart Totals</h4>
                                <div class="sub-total">
                                    <h5>Subtotal <span class="price" x-text="totalPrice + ' SAR'"></span></h5>
                                </div>
                                <div class="shipping-cart">
                                    <h4>Shipping</h4>
                                    <label>
                                        Delivery <span class="price">30 SAR</span>
                                    </label>
                                </div>
                                <div class="price-total">
                                    <h5>Total <span class="price" x-text="(totalPrice + 30) + ' SAR'"></span></h5>
                                </div>
                                <button class="theme-btn style-one">Proceed to checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function cartData() {
            return {
                cart: @json($cart),
                get totalQuantity() {
                    return this.cart.reduce((sum, item) => sum + item.quantity, 0);
                },
                get totalPrice() {
                    return this.cart.reduce((sum, item) => sum + (item.size.price * item.quantity), 0);
                },
                increaseQuantity(index) {
                    this.cart[index].quantity++;
                },
                decreaseQuantity(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                    }
                },
                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },
                clearCart() {
                    this.cart = [];
                }
            };
        }
    </script>
</x-layout>
