@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Product</h3>
                            </div>
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Pilih Kategori</label>
                                        <select id="category_id" name="category_id" class="form-control custom-select">
                                            <option value="">Pilih Subkategori</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="subcategory_id">Pilih Subkategori</label>
                                        <select id="subcategory_id" name="subcategory_id"
                                            class="form-control custom-select">
                                            <option value="">Pilih Subkategori</option>
                                        </select>
                                        @error('subcategory_id')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brand_id">Pilih Brand</label>
                                        <select id="brand_id" name="brand_id" class="form-control custom-select">
                                            @foreach ($brands as $b)
                                                <option value="{{ $b->id }}">{{ $b->brandname }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="brandname">Nama Product</label>
                                        <input type="text" class="form-control" id="product" name="productname"
                                            value="{{ old('productname') }}" placeholder="Masukan Nama Produk">
                                        @error('productname')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brandname">Kode Produk</label>
                                        <input type="text" class="form-control" id="product" name="productcode"
                                            value="{{ old('productcode') }}" placeholder="Masukan Nama Produk">
                                        @error('productcode')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brandname">Berat</label>
                                        <input type="text" class="form-control" id="product" name="productweight"
                                            value="{{ old('productweight') }}" placeholder="Masukan Berat">
                                        @error('productweight')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="brandname">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock"
                                            value="{{ old('stock') }}" placeholder="Masukan Stock">
                                        @error('stock')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga</label>
                                        <input type="" class="form-control" id="price" name="price"
                                            value="{{ old('price') }}" placeholder="Masukan price">
                                        @error('price')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="desc" rows="3" placeholder="Masukan Deskripsi..."></textarea>
                                        @error('desc')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple" class="form-label">Multiple files input
                                            example</label>
                                        <input class="form-control" name="url[]" type="file" id="formFileMultiple"
                                            multiple>
                                        @error('url')
                                            <small class="text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit"
                                        class="btn btn-primary float-right swalDefaultSuccess">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#category_id').on('change', function() {
                var categoryId = $(this).val();
                $.ajax({
                    url: "{{ route('product.fetchSubcategories') }}", // Use the named route here
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        $('#subcategory_id').empty(); // Clear existing options
                        $.each(response, function(index, subcategory) {
                            $('#subcategory_id').append($('<option/>', {
                                value: subcategory.id,
                                text: subcategory.name
                            }));
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                        // Handle errors appropriately
                    }
                });
            });
        });
    </script>
    <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Format input harga saat mengetik
            $('#price').on('input', function() {
                var input = $(this).val();
                if (input !== '') {
                    input = input.replace(/\D/g, ''); // Hapus semua karakter non-digit
                    input = input.replace(/^0+/, ''); // Hapus angka 0 di awal
                    input = input.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Tambahkan koma setiap 3 digit
                    $(this).val('Rp. ' + input);
                }
            });

            // Hapus "Rp" saat submit form
            $('form').on('submit', function() {
                var priceInput = $('#price');
                var priceValue = priceInput.val();
                priceValue = priceValue.replace(/\D/g, ''); // Hapus semua karakter non-digit
                priceInput.val(priceValue);
            });
        });
    </script>
@endsection
