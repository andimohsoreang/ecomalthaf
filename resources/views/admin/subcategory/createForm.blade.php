@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subcategories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Subcategories</li>
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
                                <h3 class="card-title">Tambah Data Subcategories</h3>
                            </div>
                            <form action="{{ route('subcategory.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputStatus">Pilih Categories</label>
                                        <select id="inputStatus" name="category_id" class="form-control custom-select">
                                            @foreach ($subcategories as $subcategory )    
                                            {{-- <option selected disabled value="{{ old('subcategories',$subcategory) }}">{{ old('subcategories', $subcategory->name) }}</option> --}}
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('subcategory')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="brandname">Nama Subcategory</label>
                                        <input type="text" class="form-control" id="category" name="name" value="{{ old('subcategory' ) }}"
                                            placeholder="Masukan Subcategory">
                                    </div>
                                    @error('name')
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
    <!-- /.content-wrapper -->
@endsection
