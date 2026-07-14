<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Detail</title>
    @vite('resources/css/style.css')
    @vite('resources/css/Hero-Clean-images.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/bootstrap.min.js')
    @vite('resources/js/bold-and-bright.js')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

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
    <section class="py-3">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6 col-sm-12 my-2">
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            @foreach ($photoPreview as $preview)
                                <div class="carousel-item active">
                                    <img src="{{ asset($preview) }}" class="d-block w-100"><br>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-12" style="display: flex; flex-direction: column;">
                    <div class="deskripsi">
                        <h2>{{ $product->productName }}</h2>
                        <p>{{ $product->description }}</p>
                        <p>$ {{ $product->price }}</p>
                    </div>
                    <div class="order mt-auto">
                        <?php
                        $tempQty = 1;
                        ?>
                        @auth
                            <div class="row" style="padding-bottom: 15px;">
                                <form action="/home/shopping-cart" method="POST">
                                    @csrf
                                    <div class="qty-input mb-2">
                                        <button class="qty-count qty-count--minus" name="buttonBeli"
                                            value="{{ $product->id }}" onclick="updateQuantity(-1)" data-action="minus"
                                            type="button">-</button>
                                        <input class="product-qty" type="number" name="qty" min="0"
                                            max="10" value="{{ $tempQty }}" id="quantity">
                                        <button class="qty-count qty-count--add" name="buttonBeli"
                                            value="{{ $product->id }}" onclick="updateQuantity(1)" data-action="add"
                                            type="button">+</button>
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-3" name="buttonBeli"
                                        value="{{ $product->id }}">
                                        Add To cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <a href="/home">
                            Home
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-end">
                        <a href="/">
                            Home
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </section>
    <script>
        function updateQuantity(value) {
            var quantityElement = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityElement.value);

            // Ensure the quantity is not negative
            if (currentQuantity + value >= 1) {
                quantityElement.value = currentQuantity + value;
            }
        }

        function redirectToLogin() {
            window.location.href = '{{ route('login') }}';
        }

        function redirectToRegister() {
            window.location.href = '{{ route('register') }}';
        }

        function redirectToHome() {
            window.location.href = '/home';
        }

        function redirectToShop() {
            window.location.href = '/home/shop';
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
