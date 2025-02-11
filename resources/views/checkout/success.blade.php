<x-layout>
    <x-slot name="title">Checkout Success</x-slot>
    <main class="main-bg">
        <section class="checkout-section pt-120 pb-80">
            <div class="container text-center" >
                <div class="row">
                    <div class="col-xl-12">
                        <div class="checkout-wrapper" data-aos="fade-up" data-aos-duration="1200">
                            <div class="checkout-thanks">
                                <div class="checkout-thanks-inner">
                                    <div class="checkout-thanks-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <h2>Thank you for your order</h2>
                                    <p>Your order has been placed successfully</span></p>
                                    <p>We have sent you an email with the order details.</p>
                                    <a href="{{ route('home') }}" class="btn btn-primary mt-10">Continue Shopping</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

 
</x-layout>
