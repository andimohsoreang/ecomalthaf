@extends('layouts.homelayout')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Product Details</h2>
                        <p>Very us move be blessed multiply night</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="single-product.html">Product Details</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_product_img">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($products->productpictures as $p)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration - 1 }}"
                                        class="{{ $loop->iteration == 1 ? 'active' : '' }}">
                                        @if (!empty($p->url))
                                            <img src="{{ asset('storage/' . $p->url) }}" width="100%" alt="Product Image">
                                        @else
                                        {{-- <img src="{{ asset('/asset/mirashop.png') }}" width="100%"> --}}
                                        <img src="{{ asset('asset/coconut.png') }}" width="100%" alt="Default Image">
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($products->productpictures as $p)
                                    @if ($loop->first)
                                        @if (!empty($p->url))
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ '/storage/' . $p->url }}"
                                                    alt="Product Image">
                                            </div>
                                        @else
                                            <div class="carousel-item active">
                                                <img class="d-block w-100"
                                                    src="{{ asset('asset/coconut.png') }}"
                                                    alt="Default Image">
                                            </div>
                                        @endif
                                    @else
                                        @if (!empty($p->url))
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="{{ '/storage/' . $p->url }}"
                                                    alt="Product Image">
                                            </div>
                                        @else
                                            <div class="carousel-item">
                                                <img class="d-block w-100"
                                                    src="{{ asset('asset/coconut.png') }}"
                                                    alt="Default Image">
                                            </div>
                                        @endif
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $products->productname }}</h3>
                        @if ($products->promo->isEmpty())
                            <h2>Rp. {{ number_format($products->price, 0) }}</h2>
                        @else
                            <h2>Rp. {{ number_format($products->discountprice, 0) }}</h2>
                        @endif
                        <ul class="list">
                            <li>
                                <a class="active" href="#">
                                    <span>Category</span> : {{ $products->subcategory->category->name }} |
                                    {{ $products->subcategory->name }} </a><br>

                            </li>
                            <li>
                                <a href="#"> <span>Availibility</span> : {{ $products->stock }}</a>
                            </li>
                        </ul>
                        <p>
                            {{ $products->desc }}
                        </p>
                        <div class="card_area">
                            @if (!Auth::check() || !Auth::user()->isAdmin)
                                <a class="main_btn" href="{{ route('noLogin', ['product_id' => $products->id]) }}">Add to
                                    Cart</a>
                            @endif
                        </div>
                        <div class="card_area mt-2">
                            <a class="main_btn" style="background-color: white; color:green; "
                                href="{{ route('home.index') }}">Lanjutkan Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                        aria-controls="profile" aria-selected="false">Specification</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>
                        {{ $products->desc }}
                    </p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <h5>Width</h5>
                                    </td>
                                    <td>
                                        <h5>128mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Height</h5>
                                    </td>
                                    <td>
                                        <h5>508mm</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Weight</h5>
                                    </td>
                                    <td>
                                        <h5>{{ $products->productweight }}</h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->
@endsection
