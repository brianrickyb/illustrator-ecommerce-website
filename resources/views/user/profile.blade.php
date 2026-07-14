<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>
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
    input,
    textarea {
        background: transparent !important;
        border-color: #D77784 !important;
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
    @auth
        <!-- Content -->
        <div class="border-md p-4 d-flex flex-column align-items-center rounded" style="color: #CE7B7A;">
            <h1 class="text-center"><strong>Profile</strong></h1>
            <div class="row justify-content-center">
                <div>
                    <img src="{{ URL::asset('images/logo-full.svg') }}" alt="Profile Page" class="rounded-circle"
                        style="width: 250px; height: 200px">
                </div>
            </div>
            <form action="{{ route('updateProfile') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mt-4"> <!-- Removed unnecessary classes from the parent div -->
                    @if ($errors)
                        <ul class="list-unstyled" style="color: red;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="socialMedia" class="form-label">Socials:</label>
                        <input type="text" class="form-control" id="socialMedia" name="socialMedia"
                            value="{{ $user->socialMedia ?? 'No socials set.' }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" id="address" name="address" rows="4">{{ $user->address ?? 'Location unknown' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country:</label>
                        <input type="text" class="form-control" id="country" name="country"
                            value="{{ $user->country ?? 'No country set' }}">
                    </div>

                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Postal Code:</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode"
                            value="{{ $user->postalCode ?? 'No postal code set' }}">
                    </div>

                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                            value="{{ $user->phoneNumber ?? 'There is no number!' }}">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" id="profile-button" role="button">Save</button>
                </div>
            </form>
        </div>
    @else
        <div>Please login/register first!</div>
    @endauth

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
