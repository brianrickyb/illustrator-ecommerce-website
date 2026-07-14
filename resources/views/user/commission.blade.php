<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commissions — {{ config('app.name') }}</title>
    <meta name="description"
        content="Open commissions for illustration work. See pricing, portfolio samples, and how to order.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Commissions — {{ config('app.name') }}">
    <meta property="og:description" content="Open commissions for illustration work — pricing and portfolio samples.">
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
                        <img src="{{ URL::asset('images/logo-icon.svg') }}" alt="{{ config('app.name') }}" class="logo-nav" />
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
                        <img src="{{ URL::asset('images/logo-icon.svg') }}" alt="{{ config('app.name') }}" class="logo-nav" />
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
    <br>
    <div class="container commission-section mb-4" style="color: #D48A86">
        <h2 class="text-center mb-4"><b>C O M M I S S I O N</b></h2>
        <p class="text-center">Scroll down this page to view commission prices and portfolios, or click the buttons
            below!</p>
        <div class="text-center">Commission status: OPEN</div>
        <div class="commission-card text-center">
            <a href="https://vgen.co/ireneparamithaa" class="commission-button circular-button"
                style="background-color: #B7CFF2; color: #FFFFFF; font-size: 15px"><b>O R D E R</b></a>
            <a href="https://trello.com/b/XIv0XmR5/irenes-commission-tracker-%E2%97%8F%E2%96%BD%E2%97%8F%E3%82%9D"
                class="commission-button circular-button"
                style="background-color: #FFDFAE; color: #FFFFFF; font-size: 15px"><b>T R A C K</b></a>
            <a href="https://irenecommsfaq.carrd.co/" class="commission-button circular-button"
                style="background-color: #FEC5CB; color: #FFFFFF; font-size: 15px"><b>F . A . Q</b></a>

            <div class="text-center">Prices in USD, local rate ꒰ USD 1 = IDR 15,000 ꒱</div>
        </div>
        <br>
        <div class="commission-card text-center">
            <div class="card-body">
                <img src="{{ URL::asset('images/slide1.jpg') }}" class="d-block w-100" alt="Commission price list — page 1"
                    style="max-width: 100%; max-height: 100%;" loading="lazy" decoding="async">
            </div><br>
            <div class="card-body">
                <img src="{{ URL::asset('images/slide2.jpg') }}" class="d-block w-100" alt="Commission price list — page 2"
                    style="max-width: 100%; max-height: 100%;" loading="lazy" decoding="async">
            </div><br>
            <div class="card-body">
                <img src="{{ URL::asset('images/slide3.jpg') }}" class="d-block w-100" alt="Commission price list — page 3"
                    style="max-width: 100%; max-height: 100%;" loading="lazy" decoding="async">
            </div><br>
            <h5 class="card-title commission-header"><b>For More Detail On Vgen</b></h5>
            <!-- Bagian Chibi -->
            {{-- <div class="card commission-card">
                <div class="card-body">
                    <p class="card-text commission-subheader" style="margin-bottom: 0px">Chibi character illustration
                        with simple colored
                        background.</p>
                    <p> Fully illustrated background available with additional fee.</p>
                    <!-- Daftar Harga Chibi -->
                    <p>Head Only $10<br> Bust $15<br> Fullbody $20<br> Paypal Fee $6<br> Rush Deadline $10<br>
                        Complicated Design/BG $15-20<br> Commercial Use $30<br> PSD File $10</p>
                </div>
            </div> --}}

            <!-- Bagian Profile Icons -->
            {{-- <div class="card commission-card">
                <div class="card-body">
                    <h5 class="card-title commission-header"><b>Profile Icons</b></h5>
                    <p class="card-text commission-subheader">Bust character illustration with additional ornaments and
                        simple colored background. Fully illustrated background available with additional fee.</p>
                    <!-- Daftar Harga Profile Icons -->
                    <p>Single $35<br> Couple $65<br> Paypal Fee $6<br> Rush Deadline $10<br> Complicated Design/BG
                        $15-20<br> Commercial Use $30<br> PSD File $10</p>
                </div>
            </div> --}}

            <!-- Bagian Characters -->
            {{-- <div class="card commission-card">
                <div class="card-body">
                    <h5 class="card-title commission-header"><b>Characters</b></h5>
                    <p class="card-text commission-subheader">Fullbody character illustration with simple colored
                        background. Fully illustrated background available with additional fee.</p>
                    <!-- Daftar Harga Characters -->
                    <p>Single $65<br> Couple $120<br> Paypal Fee $6<br> Rush Deadline $10<br> Complicated Design/BG
                        $15-20<br> Commercial Use $30<br> PSD File $10</p>
                </div>
            </div> --}}
        </div>
    </div>
    <script>
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
