<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop Page</title>
    @vite('resources/css/style.css')
    @vite('resources/css/Hero-Clean-images.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/bootstrap.min.js')
    @vite('resources/js/bold-and-bright.js')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<style>
    @media (max-width: 767px) {
        .nav.sideNavbar {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center;
            text-align: center;
            flex-direction: row !important;
        }
    }
</style>



<body>
    <div class="nav-wrapper nav-wrapper-1">
        <nav class="navbar navbar-expand-lg navbar-light bg-nav-custom effect-1">
            <div class="container">
                @auth
                    <a class="navbar-brand" href="/home" style="width: 200px">
                        <img src="{{ URL::asset('images/logo-icon.svg') }}" alt="" class="logo-nav" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-lg-0 nav-item-custome">
                            <li class="nav-item">
                                <a class="nav-link active" href="/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/commission">Commision</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/shop">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/about">About</a>
                            </li>
                            <li>
                                <div class="button-container justify-content-center">
                                    <button id="cart-button" onclick="redirectToCart()"><i
                                            class="fa-solid fa-cart-shopping"></i></button>
                                    <button id="profile-button" onclick="redirectToProfile()"><i
                                            class="fa-solid fa-user"></i></button>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" id="profile-button" role="button">LogOut</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="navbar-brand" href="/" style="width: 200px">
                        <img src="{{ URL::asset('images/logo-icon.svg') }}" alt="" class="logo-nav" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-lg-0 nav-item-custome">
                            <li class="nav-item">
                                <a class="nav-link active" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/commission">Commision</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/shop">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/about">About</a>
                            </li>
                            <li>
                                <div class="button-container justify-content-center">
                                    <button type="submit" id="profile-button" role="button"
                                        onclick="redirectToLogin()">LogIn</button>
                                    <button type="submit" id="profile-button" role="button"
                                        onclick="redirectToRegister()">Register</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>
    </div>
    <section>
        <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ URL::asset('images/banner1.jpg') }}" class="d-block w-100"
                        alt="Slide 1" style="max-width: 100%; max-height: 100%;">
                </div>
                <div class="carousel-item">
                    <img src="{{ URL::asset('images/banner2.jpg') }}"
                        class="d-block w-100" alt="Slide 2" style="max-width: 100%; max-height: 100%;">
                </div>
                <div class="carousel-item">
                    <img src="{{ URL::asset('images/banner3.jpg') }}"
                        class="d-block w-100" alt="Slide 2" style="max-width: 100%; max-height: 100%;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <br><br>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-2 d-md-block sidebar">
                    <nav id="sidebar" class="sidebar">
                        <div class="">
                            <ul class="nav sideNavbar flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#" data-category="all"
                                        style="color: black">
                                        All
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-category="artbook" style="color: black">
                                        Artbook
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-category="charms" style="color: black">
                                        Charms
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-category="photocard"
                                        style="color: black">
                                        Photocard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-category="print" style="color: black">
                                        Print
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-12 col-md-9 col-lg-10">
                    <div class="row">
                        @foreach ($products as $key => $product)
                            <div class="col-md-4 col-sm-6 {{ strtolower($product->category) }}">
                                <div class="card product-card mb-3">
                                    <a href="/shopproductdetail/{{ $product->id }}">
                                        <section class="panel">
                                            <div class="pro-img-box text-center mb-2">
                                                <img src="{{ asset($photos[$key]) }}" class="card-img-top"
                                                    alt="Product Image" style="width: 100%; height: 200px;">
                                            </div>
                                            <div class="panel-body">
                                                <div class="d-flex flex-column align-items-left">
                                                    <h5 class="mb-0">{{ $product->productName }}</h5>
                                                    <p class="mb-0">$ {{ $product->price }}</p>
                                                </div>
                                                @auth
                                                    <div class="d-flex align-items-center mt-2"
                                                        style="justify-content: right;">
                                                        <form action="/home/shopping-cart" method="POST">
                                                            @csrf
                                                            <button type="submit" name="buttonBeli"
                                                                value="{{ $product->id }}" class="btn"
                                                                id="profile-button" style="margin:0px !important;">Add to
                                                                Cart</button>
                                                        </form>
                                                    </div>
                                                @endauth
                                            </div>
                                        </section>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Filter products based on selected category
            $('nav#sidebar a').on('click', function(e) {
                e.preventDefault();
                const category = $(this).data('category');
                if (category === 'all') {
                    $('.col-md-4.col-sm-6').show(); // Update the selector here
                } else {
                    $('.col-md-4.col-sm-6').hide(); // Update the selector here
                    $(`.${category}`).show();
                }
            });
        });

        function redirectToLogin() {
            window.location.href = '{{ route('login') }}';
        }

        function redirectToRegister() {
            window.location.href = '{{ route('register') }}';
        }

        function redirectToCart() {
            window.location.href = '/home/shopping-cart';
        }

        function redirectToProfile() {
            window.location.href = '/home/profileuser';
        }
    </script>
</body>

</html>
