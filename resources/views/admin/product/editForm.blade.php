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
                            <form action="{{ route('product.update', $products->id)  }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Pilih Kategori</label>
                                        <select id="category_id" name="category_id" class="form-control custom-select">
                                            <option value="">Pilih Subkategori</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="subcategory_id">Pilih Subkategori</label>
                                        <select id="subcategory_id" name="subcategory_id"
                                            class="form-control custom-select">
                                            
                                        </select>
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
                                            value="{{ $products->productname }}" placeholder="Masukan Nama Produk">
                                    </div>
                                    @error('productname')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="brandname">Kode Produk</label>
                                        <input type="text" class="form-control" id="product" name="productcode"
                                            value="{{ $products->productcode }}" placeholder="Masukan Nama Produk">
                                    </div>
                                    @error('productcode')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="form-group">
                                        <label for="brandname">Berat</label>
                                        <input type="text" class="form-control" id="product" name="productweight"
                                            value="{{ $products->productweight }}" placeholder="Masukan Berat">
                                    </div>
                                    @error('productweight')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="brandname">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock"
                                            value="{{ $products->stock }}" placeholder="Masukan Stock">
                                    </div>
                                    @error('stock')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="price">price</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ $products->price }}" placeholder="Masukan price">
                                    </div>
                                    @error('price')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" value={{ $products->desc }} name="desc" rows="3" placeholder="Masukan Deskripsi..."></textarea>
                                    </div>
                                    @error('desc')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <label for="">Gambar</label>
                                     <div class="div mb-3">
                                        @foreach ($products->productpictures as $i )
                                            <img src="{{ '/storage/'. $i->url }}" alt="" width="20%">
                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFileMultiple"  class="form-label">Multiple files input
                                            example</label>
                                        <input class="form-control" name="url[]" type="file" id="formFileMultiple" multiple>
                                    </div>
                                    @error('url')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                   
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
