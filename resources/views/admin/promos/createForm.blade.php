@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Promo Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Promos</li>
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
                                <h3 class="card-title">Tambah Data Promo</h3>
                            </div>
                            <form action="{{ route('promo.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="product_id">Pilih Product</label>
                                        <select id="product_id" name="product_id" class="form-control select2bs4"
                                            style="width: 100%;">
                                            <option selected="selected">Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    <p class="text text-bold">{{ $product->productcode }}</p> |
                                                    {{ $product->productname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="number" class="form-control" id="discount" name="discount"
                                            value="{{ old('discount') }}" placeholder="Masukan Discount">
                                    </div>
                                    @error('discount')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label>Pilih Waktu Promo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="reservationtime">
                                        </div>

                                        <input type="hidden" name="start_date" id="start_date_input">
                                        <input type="hidden" name="end_date" id="end_date_input">
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    <!-- /.content-wrapper --> --}}
@endsection

@section('script')
    <script>
        $(function() {
            // Inisialisasi Daterangepicker dengan opsi time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            }, function(start, end, label) {
                // Callback ini akan dipanggil setiap kali rentang tanggal berubah
                // Anda dapat mengakses nilai start date dan end date di sini
                var startDate = start.format('YYYY-MM-DD');
                var endDate = end.format('YYYY-MM-DD');

                // Ubah nilai input tersembunyi untuk menyimpan nilai start date dan end date
                $('#start_date_input').val(startDate);
                $('#end_date_input').val(endDate);

                // Lakukan apa pun yang Anda perlukan dengan nilai start date dan end date
                console.log('Start Date:', startDate);
                console.log('End Date:', endDate);
            });
        });

        
    </script>
@endsection
