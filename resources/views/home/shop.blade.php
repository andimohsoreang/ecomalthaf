@extends('layouts.homelayout')
@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Shop List</h2>
                        <p>Lihat Produk Untuk Kulitmu!</p>
                    </div>
                    <div class="page_link">
                        <a href="index.html">Home</a>
                        <a href="category.html">Shop</a>
                        <a href="category.html">All Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
    <!--================Category Product Area =================-->
    <section class="cat_product_area section_gap">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="product_top_bar">
                        <div class="left_dorp">
                            <select class="sorting">
                                <option value="1">Default sorting</option>
                                <option value="2">Default sorting 01</option>
                                <option value="4">Default sorting 02</option>
                            </select>
                            <select class="show">
                                <option value="1">Show 12</option>
                                <option value="2">Show 14</option>
                                <option value="4">Show 16</option>
                            </select>
                        </div>
                    </div>

                    <div class="latest_product_inner">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-product">
                                        <div class="product-img">
                                            @if (!$product->productpictures->isEmpty())
                                                        @if ($product->productpictures->where('url', '!=', '')->isNotEmpty())
                                                            <img src="{{ 'storage/' . $product->productpictures->where('url', '!=', '')->first()->url }}"
                                                                alt="" style="width: 100%">
                                                        @else
                                                            <img src="{{ asset('storage/images-product/coconut.png') }}"
                                                                alt="" style="width: 100%">
                                                        @endif
                                                    @endif
                                            
                                        </div>
                                        <div class="product-btm">
                                            <a href="{{ route('showProducts', ['id' => $product->id]) }}" class="d-block">
                                                <h4> <strong>{{ $product->productname }}</strong> </h4>
                                            </a>
                                            <div class="mt-3">
                                                <span class="mr-4">Rp. {{ number_format($product->price, 0) }}</span>
                                                {{-- <del>$35.00</del> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Kategori</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($categories as $category)
                                        <li>
                                            <a
                                                href="{{ route('home.index', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Subcategories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    @foreach ($subcategories as $subcategory)
                                        <li>
                                            <a href="{{ route('home.index', ['subcategory_id' => $subcategory->id]) }}">{{ $subcategory->category->name }}
                                                | {{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </aside>


                        {{-- <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Price Filter</h3>
                            </div>
                            <div class="widgets_inner">
                                <div class="range_item">
                                    <div id="slider-range"></div>
                                    <div class="">
                                        <label for="amount">Price : </label>
                                        <input type="text" id="amount" readonly />
                                    </div>
                                </div>
                            </div>
                        </aside> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->
@endsection
