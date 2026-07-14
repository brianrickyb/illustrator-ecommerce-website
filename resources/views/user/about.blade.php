<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
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
    <section>
        <div class="container text-center d-flex flex-column align-items-center">
            <div class="row gy-4 gy-md-0">
                <div class="col-md-4 col-sm-6">
                    <img class="image--cover img-fluid fit-cover"
                        src="{{ URL::asset('images/about.jpg') }}">
                </div>
                <div class="col-md-8 col-sm-6 d-md-flex align-items-md-center">
                    <div style="max-width: 500px; text-align:left; margin-left: 30px">
                        <h2 class="text-uppercase fw-bold" style="color: #D77784">Meet Irene!</h2>
                        <p class="my-3">She's a self-taught kidlit illustrator and merch artist. Irene has been
                            building her work since 2020, and started offline events in 2023. Her works are often
                            described as warm and sweet, just like cotton candy! Her little girl dream of doing art for
                            life is slowly coming true as she slowly grows with her work.</p>
                        <h2 class="text-uppercase fw-bold" style="color: #D77784">Contact</h2>
                        <p class="my-3"><em><u>hello.ireneparamitha@gmail.com</u></em></p>
                    </div>
                </div>
            </div>
            <div class="row mt-5" style="max-width: 650px">
                <div class="col-12 text-center mb-4">
                    <h2 style="color: #7F9ACF"><b>Do you want to meet her and her work?</b></h2>
                    <p>
                        <i>
                            Irene has done several offline art event and conventions. Surely she would love to meet you
                            on
                            her next one!
                        </i>
                    </p>
                </div>
                <div class="col-12 text-center mb-4">
                    <h4><b>Future Events</b></h4>
                    <p style="margin-bottom: 0px">✧ <b>Comic Frontier 17,</b> ICE BSD City, ID (Dec 2023)</p>
                    <p>✧ <b>Cocoon Comic Market,</b> Ciputra Dian Ballroom, ID (Feb 2023)</p>
                </div>
                <div class="col-12 text-center mb-4">
                    <h4><b>2023</b></h4>
                    <p style="margin-bottom: 0px">✧ <b>Comic Frontier 16,</b> ICE BSD City, ID (May 2023)</p>
                    <p style="margin-bottom: 0px">✧ <b>P-Land Vol.2,</b> SMESCO, ID (July 2023)</p>
                    <p>✧ <b>Kira Kira Art Market 01,</b> Open Door, ID (Aug 2023)</p>
                </div>
                <div class="col-12 text-center mb-4">
                    <h4><b>2022</b></h4>
                    <p>✧ <b>Loomifair,</b> Mbloc Space, ID (Aug 2022)</p>
                </div>
            </div>
        </div>
    </section>
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
