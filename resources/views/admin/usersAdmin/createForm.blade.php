@extends('layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                <h3 class="card-title">Tambah Data Admin</h3>
                            </div>
                            <form action="{{ route('user.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="name"
                                            value="{{ old('name') }}" placeholder="Masukan Nama Lengkap">
                                    </div>
                                    @error('name')
                                        <small class="text text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" placeholder="Masukan Nama Email">
                                </div>
                                @error('email')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukan Nama Password">
                                </div>
                                @error('password')
                                    <small class="text text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right swalDefaultSuccess">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>



    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
