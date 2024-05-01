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
                        <div class="col-lg-12 col-md-7 col-sm-12">
                            <div class="order_box">
                                <h2 class="mb-4">Orderanmu</h2>
                                <table class="table table-bordered table-striped table-hover rounded">
                                    <thead class="thead-dark rounded-top">
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th class="d-none d-md-table-cell">Kuantitas</th>
                                            <th class="d-none d-md-table-cell">Total Pembayaran</th>
                                            <th class="d-none d-md-table-cell">Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->numinvoice }}</td>
                                                <td class="d-none d-md-table-cell">{{ $d->totalQty }}</td>
                                                <td class="d-none d-md-table-cell">Rp. {{ number_format($d->totalPrice, 0, ',', '.') }}</td>
                                                <td class="d-none d-md-table-cell">{{ $d->status == 'Ditolak' ? $d->evidencepayment[0]->reason : $d->status }}</td>
                                                <td><span class="badge badge-success rounded-pill">{{ $d->status }}</span></td>
                                                <td>
                                                   
                                                        <a class="btn btn-sm main_btn {{ in_array($d->status,['Diproses','Ditolak']) ? 'disabled' : ''}}" href="{{ route('detailsOrder.show', $d->id) }}" >
                                                        Upload Bukti Pembayaran
                                                        </a>
                                                        
                                                        
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
        </section>
        <!--================End Checkout Area =================-->
    @endsection
