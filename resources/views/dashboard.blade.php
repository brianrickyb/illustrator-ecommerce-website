<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} — Illustration & Merch Portfolio</title>
    <meta name="description"
        content="Selected illustration work by Irene Paramitha — murals, prints, charms, and photocards. Browse the collection and shop originals.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name') }} — Illustration & Merch Portfolio">
    <meta property="og:description" content="Selected illustration work — murals, prints, charms, and photocards.">
    <meta property="og:image" content="{{ URL::asset('images/logo-full.svg') }}">
    <meta name="twitter:card" content="summary">
    @vite('resources/css/style.css')
    @vite('resources/css/Hero-Clean-images.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/bootstrap.min.js')
    @vite('resources/js/bold-and-bright.js')
    @vite('resources/css/home.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,500&family=Inter:wght@300;400;500;600&display=swap" />
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

    @php
        $detailBase = auth()->check() ? '/home/homeproductdetail' : '/homeproductdetail';
        $categories = $products->pluck('category')->filter()->unique()->sort()->values();
    @endphp

    <div class="showcase-intro">
        <p class="showcase-eyebrow">Portfolio</p>
        <h1 class="showcase-title">Selected Works</h1>
        <p class="showcase-subtitle">A collection of illustrations, charms, and prints — hover a piece to see what
            it's about.</p>
    </div>

    @if ($categories->isNotEmpty())
        <div class="gallery-filters">
            <button type="button" class="gallery-filter-btn active" data-filter="all">All</button>
            @foreach ($categories as $category)
                <button type="button" class="gallery-filter-btn" data-filter="{{ $category }}">
                    {{ ucfirst($category) }}
                </button>
            @endforeach
        </div>
    @endif

    <div class="py-4 container">
        <div class="container-gallery">
            @foreach ($products as $key => $product)
                <div class="gallery-item {{ $key % 3 == 0 ? 'big' : (($key + 1) % 3 == 0 ? 'horizontal' : 'vertical') }}"
                    data-category="{{ $product->category }}">
                    <a href="{{ $detailBase }}/{{ $product->id }}" class="gallery-item-link">
                        <img class="img-fluid rounded" src="{{ asset($photos[$key]) }}"
                            alt="{{ $product->productName }}" height="100%" width="100%"
                            @if ($key > 2) loading="lazy" @endif decoding="async" />
                        <div class="gallery-overlay">
                            <span class="gallery-overlay-category">{{ ucfirst($product->category) }}</span>
                            <h3 class="gallery-overlay-title">{{ $product->productName }}</h3>
                            <p class="gallery-overlay-desc">{{ Illuminate\Support\Str::limit($product->description, 90) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
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

        document.querySelectorAll('.gallery-filter-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.gallery-filter-btn').forEach(function (b) {
                    b.classList.remove('active');
                });
                btn.classList.add('active');
                var filter = btn.dataset.filter;
                document.querySelectorAll('.gallery-item').forEach(function (item) {
                    item.style.display = (filter === 'all' || item.dataset.category === filter) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>
