    @extends('layouts.homelayout')
    @section('content')
        <!--================Home Banner Area =================-->
        <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content d-md-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <h2>Periksa Pembayaran</h2>
                            <p>Dikit lagi!</p>
                        </div>
                        <div class="page_link">
                            <a href="index.html">Home</a>
                            <a href="checkout.html">Product Final Checkout</a>
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
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <div class="payment-info mb-4">
                                <h4 class="mb-3">Informasi Pembayaran</h4>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="bank-logo mr-3" style="width: 10%">
                                            <img src="{{ asset('asset/mirashop.png') }}" alt="Bank ABC" class="img-fluid">
                                        </div>
                                        <div>
                                            <strong>Bank ABC</strong>
                                            <p class="mb-0">Nama Pemilik: John Doe</p>
                                            <span>1234567890</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="bank-logo mr-3" style="width: 10%">

                                            <img src="{{ asset('asset/mirashop.png') }}" alt="Bank ABC" class="img-fluid">

                                        </div>
                                        <div>
                                            <strong>Bank XYZ</strong>
                                            <p class="mb-0">Nama Pemilik: Jane Smith</p>
                                            <span>0987654321</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div class="bank-logo mr-3" style="width: 10%">
                                            <img src="{{ asset('asset/mirashop.png') }}" alt="Bank ABC" class="img-fluid">
                                        </div>
                                        <div>
                                            <strong>Bank PQR</strong>
                                            <p class="mb-0">Nama Pemilik: Michael Johnson</p>
                                            <span>5555555555</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-12 mt-4">
                            <form action="{{ route('detailsOrder.store') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-box">
                                    <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
                                    <h4 class="mb-3 mt-4">Bukti Pembayaran</h4>
                                    <form>
                                        <div class="form-group">
                                            <input type="file" name="url" class="form-control-file"
                                                id="payment-proof">
                                        </div>
                                        <button type="submit" class="btn btn-primary main_btn">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Checkout Area =================-->
    @endsection
