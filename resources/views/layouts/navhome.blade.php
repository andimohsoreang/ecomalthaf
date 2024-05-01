<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: +01 256 25 235</p>
                        <p>email: sashop@mail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <img src="{{ asset('asset/mirashop.png') }}" style="width: 17%" alt="" />
                <a class="navbar-brand logo_h" href="index.html">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('landingpage') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.index') }}">Shop</a>
                                </li>
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('carts') }}">Carts</a>
                                    </li>
                                @else
                                    <p></p>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.promo') }}">Promo</a>
                                </li>
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('detailsOrder') }}">Order</a>
                                    </li>
                                @endif
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                @if (Auth::check())
                                    <li class="nav-item">
                                        <a href="{{ route('carts') }}" class="icons">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </li>
                                @endif


                                <li class="nav-item">
                                    <a href="#" class="icons">
                                        <i class="ti-user" aria-hidden="true"></i>
                                        @if (Auth::check())
                                            <small> Halo, <strong>{{ Auth::user()->name }}</strong></small>
                                        @else
                                            <small></small>
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================Header Menu Area =================-->
