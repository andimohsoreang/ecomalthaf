@extends('layouts.homelayout')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Cart</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="cart.html">Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $c)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex" style="width: 10%">

                                                <img src="{{ '/storage/' . $c->product->productpictures[0]->url }}"
                                                    width="100%" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $c->product->productname }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <h5>Rp. {{ number_format($c->product->price, 2) }}</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text" name="qty[]" id="sst_{{ $c->product->id }}"
                                                maxlength="12" value="1" title="Quantity:" class="input-text qty" />
                                            <form action="{{ route('checkout') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_qty[{{ $c->product->id }}]"
                                                    id="product_qty_{{ $c->product->id }}" value="1">
                                                <button
                                                    onclick="increaseQuantity({{ $c->product->id }}, {{ $c->product->price }})"
                                                    class="increase items-count" type="button"><i
                                                        class="lnr lnr-chevron-up"></i></button>
                                                <button
                                                    onclick="decreaseQuantity({{ $c->product->id }}, {{ $c->product->price }})"
                                                    class="reduced items-count" type="button"><i
                                                        class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 id="total-price_{{ $c->product->id }}">Rp. 0</h5>
                                    </td>
                                </tr>
                            @endforeach



                            <tr class="bottom_button">
                                <td>
                                    <a class="gray_btn" href="#">Cart Item</a>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
                                    <h5 id="subtotal">Rp. 0</h5>
                                </td>
                            </tr>

                            <tr class="out_button_area">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="checkout_btn_inner">
                                        <a class="gray_btn" href="{{ route('home.index') }}">Continue Shopping</a>
                                        <button class="main_btn" type="submit">Proceed to checkout</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let quantities = {};
        let prices = {};
        let subtotal = 0;

        @foreach ($carts as $c)
            quantities[{{ $c->product->id }}] = 1;
            prices[{{ $c->product->id }}] = {{ $c->product->price }};
            updateTotalPrice({{ $c->product->id }});
        @endforeach

        function increaseQuantity(productId, productPrice) {
            quantities[productId]++;
            updateTotalPrice(productId, productPrice);
            updateSubtotal();
        }

        function decreaseQuantity(productId, productPrice) {
            if (quantities[productId] > 1) {
                quantities[productId]--;
                updateTotalPrice(productId, productPrice);
                updateSubtotal();
            }
        }

        function updateTotalPrice(productId, productPrice) {
            const totalPrice = quantities[productId] * prices[productId];
            const formattedTotalPrice = totalPrice.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            document.getElementById('total-price_' + productId).textContent = formattedTotalPrice;
            document.getElementById('sst_' + productId).value = quantities[productId];
            document.getElementById('product_qty_' + productId).value = quantities[
            productId]; // Perbarui nilai input tersembunyi
        }

        function updateSubtotal() {
            subtotal = 0;
            for (const productId in quantities) {
                const totalPrice = quantities[productId] * prices[productId];
                subtotal += totalPrice;
            }
            const formattedSubtotal = subtotal.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
            document.getElementById('subtotal').textContent = formattedSubtotal;
        }
    </script>
@endsection
