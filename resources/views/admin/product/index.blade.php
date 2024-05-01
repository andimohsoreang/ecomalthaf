@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (@session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Products</h3>
                            </div>

                            <div class="card-body">
                                <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Thumbnail</th>
                                            <th>Code</th>
                                            <th>Product</th>
                                            <th>Kategori</th>
                                            <th>Subkategori</th>
                                            <th>Harga</th>

                                            <th>Stok</th>
                                            <th>Status</th>

                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="max-width:150px">
                                                    @if (!$product->productpictures->isEmpty())
                                                        @if ($product->productpictures->where('url', '!=', '')->isNotEmpty())
                                                            <img src="{{ 'storage/' . $product->productpictures->where('url', '!=', '')->first()->url }}"
                                                                alt="" style="width: 50%">
                                                        @else
                                                            <img src="{{ asset('storage/images-product/coconut.png') }}"
                                                                alt="" style="width: 50%">
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>{{ $product->productcode }}</td>
                                                <td>{{ $product->productname }}</td>
                                                <td>{{ $product->subcategory->category->name }}</td>
                                                <td>{{ $product->subcategory->name }}</td>
                                                <td>Rp. {{ number_format($product->price, 0) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    @if ($product->isActive == true)
                                                        <span class="badge badge-primary">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">NonAktif</span>
                                                    @endif
                                                    {{-- {{ $product->isActive }} --}}
                                                </td>
                                                <td>
                                                    <a href="{{ route('product.edit', $product->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('product.destroy', $product->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus merek ini?')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
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

    </div>

    <!-- /.content-wrapper -->
@endsection
