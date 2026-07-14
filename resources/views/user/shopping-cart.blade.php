<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <meta name="robots" content="noindex, nofollow">
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
    @media only screen and (max-width: 767px) {
        .orderDetail {
            flex-direction: column;
            align-items: flex-start;
        }

        .orderInfo,
        .orderQty {
            display: flex;
            flex-direction: row !important;
            margin-bottom: 0px;
            max-width: 150px;
        }

        .orderInfo p {
            margin-top: 10px;
            margin-right: 50px;
        }

        /* .orderQty {
            margin-top: 10px;
        } */
    }
</style>

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

    <div class="container">
        <h1>Shopping Cart</h1>
        <div>
            <?php $totalPrice = 0; ?>
            @foreach ($cartData as $cartItem)
                <div class="orderDetail"
                    style="display: flex; justify-content:space-between; margin:10px; align-items:center">
                    <img src="{{ $cartItem['photoUrl'] }}" alt="Product Photo" style="max-width:30%; max-height:30%;">
                    <div class="orderInfo">
                        <p>{{ $cartItem['product']->productName }}</p>
                        <p>{{ $cartItem['category'] }}</p>
                    </div>
                    <div class="orderQty" style="display: flex; justify-content:space-between; gap:30px">
                        <form method="post" action="{{ route('removeCartItem') }}">
                            @csrf
                            <button type="submit" name="btnProductID" value="{{ $cartItem['idProduct'] }}"
                                style="border: none; background-color: transparent; outline: none;">-</button>
                        </form>
                        <p>{{ $cartItem['qty'] }}</p>
                        <form method="post" action="{{ route('updateCartItem') }}">
                            @csrf
                            <button type="submit" name="btnProductID" value="{{ $cartItem['idProduct'] }}"
                                style="border: none; background-color: transparent; outline: none;">+</button>
                        </form>
                    </div>
                    <p>$ {{ $cartItem['price'] }}</p>
                    <?php $totalPrice += $cartItem['price'] * $cartItem['qty']; ?>
                </div>
            @endforeach
        </div>
        <hr>
        <div style="text-align: right">
            <h3>Subtotal: $ <?= $totalPrice ?></h3>
            <form method="post" action="/home/thankyou" onsubmit="return disableButton()">
                @csrf
                <button type="submit" name="checkOut" id="checkout" class="checkOut">Checkout</button>
            </form>
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

        function disableButton() {
            var button = document.getElementById('checkout');
            button.innerHTML = 'Loading...';
            button.disabled = true;
            return true;
        }
    </script>
</body>

</html>
