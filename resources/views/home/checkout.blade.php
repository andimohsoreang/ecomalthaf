    @extends('layouts.homelayout')
    @section('content')
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content d-md-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <h2>Product Checkout</h2>
                            <p>Very us move be blessed multiply night</p>
                        </div>
                        <div class="page_link">
                            <a href="index.html">Home</a>
                            <a href="checkout.html">Product Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->

        <!--================Checkout Area =================-->
        <section class="checkout_area section_gap">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('checkout.store') }}" method="post">
                                @csrf
                                <div class="order_box">
                                    <h2>Orderanmu</h2>
                                    <ul class="list">
                                        <li>
                                            <a href="#">Product
                                                <span>Total</span>
                                            </a>
                                        </li>
                                        <li>
                                            @foreach ($data as $d)
                                            <input type="hidden" name="qty[{{ $d['products']->product->id}}]" value="{{ $d['qty'] }}">
                                            @if($d['products']->product->promo->isEmpty())
                                            <input type="hidden" name="price[{{ $d['products']->product->id}}]" value="{{ $d['products']->product->price }}">
                                            @else
                                            <input type="hidden" name="price[{{ $d['products']->product->id}}]" value="{{ $d['products']->product->price - $d['products']->product->price * $d['products']->product->promo[0]->promo_discount / 100 }}">

                                            @endif
                                                <a href="#">{{ $d['products']->product->productname }}
                                                    <span class="middle">x {{ $d['qty'] }}</span>
                                                    <span
                                                        class="last">Rp.{{ number_format($d['totalPrice'], 0, ',', '.') }}</span>
                                                </a>
                                            @endforeach
                                        </li>
                                    </ul>
                                    <ul class="list list_2">
                                        <li>
                                            <a href="#">Total
                                                <span>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <button type="submit" class="main_btn" href="{{ route('detailsOrder') }}">Pesan Produk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Checkout Area =================-->
    @endsection
