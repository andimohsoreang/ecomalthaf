@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Pembayaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">Data Pembayaran</h3>
                                <p class="text-muted text-center">Detail</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Nama Pelanggan</b> <a class="float-right">{{ $order->customer->user->name }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nomor Telepon</b> <a class="float-right">{{ $order->customer->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Pesanan</b> <a class="float-right">{{ $order->created_at }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total Harga</b> <a class="float-right">Rp. {{ number_format($totalPrice, 0) }}</a>
                                    </li>

                                </ul>
                                <div class="div">
                                    @if (!$order->evidencepayment->isEmpty() && $order->evidencepayment[0]->status != 1)
                                        <form action="{{ route('updateStatus') }}" method="POST">
                                            @csrf
                                            <div class="div mb-2">
                                                <input type="hidden" name="transaction_id" value="{{ $order->id }}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-primary">
                                                    Konfirmasi
                                                </button>
                                            </div>
                                        </form>
                                    @endif

                                    @if ($order->evidencepayment->isEmpty() || $order->evidencepayment[0]->status != 1)
                                        <div class="div">
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-default">
                                                Tolak
                                            </button>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center">Data Bukti Bayar</h3>
                                <p class="text-muted text-center">Bukti Pembayaran</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    @if (!$order->evidencepayment->isEmpty())    
                                    <img src="{{ '/storage/' . $order->evidencepayment[0]->url }}" width="30%"
                                        alt="">
                                        @else
                                        <small>Belum Ada Bukti Pembayaran</small>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">File Bukti Bayar</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @if (!$order->evidencepayment->isEmpty())
                                                <td>Lihat Bukti Bayar</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <button class="btn btn-default" data-toggle="modal"
                                                            data-target="#modal-lg">
                                                            <a href="#" class="btn btn-info"><i
                                                                    class="fas fa-eye"></i></a>
                                                        </button>
                                                    </div>
                                                </td>
                                            @else
                                                <td>Belum Ada Bukti Bayar</td>
                                                <td class="text-right py-0 align-middle"></td>
                                            @endif
                                        <tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Produk</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Gambar</th>
                                            <th>Nama Product</th>
                                            <th>Kategori</th>
                                            <th>Subkategori</th>
                                            <th>Berat</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th style="width: 40px">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->detailtransaction as $o)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="width:100px"><img
                                                        src="{{ '/storage/' . $o->product->productpictures[0]->url }}"
                                                        width="100%" alt=""></td>
                                                <td>{{ $o->product->productname }}</td>
                                                <td>{{ $o->product->subcategory->category->name }}</td>
                                                <td>{{ $o->product->subcategory->name }}</td>
                                                <td>{{ $o->product->productweight }}</td>
                                                <td>{{ $o->qty }}</td>
                                                <td>{{ $o->price }}</td>
                                                <td>{{ $o->qty * $o->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alasan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('updateStatus') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Alasan / Deskripsi</label>
                            <input type="hidden" name="transaction_id" value="{{ $order->id }}">
                            <input type="hidden" name="status" value="0">
                            <textarea class="form-control" name="reason" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            Save changes</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="div d-flex justify-content-center">
                        @if (!$order->evidencepayment->isEmpty())
                            <img src="{{ '/storage/' . $order->evidencepayment[0]->url }}" width="60%"
                                alt="">
                        @else
                            <p>Belum Ada Bukti Pembayaran</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>

    </div>
@endsection
