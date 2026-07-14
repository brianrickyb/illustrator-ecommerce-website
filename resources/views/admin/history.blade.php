<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    @vite('resources/css/style.css')
    @vite('resources/css/Hero-Clean-images.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/bootstrap.min.js')
    @vite('resources/js/bold-and-bright.js')
    @vite('resources/css/home.css')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
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
                                <a class="nav-link active" href="/home">Admin Page</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/admin/create">Add New Product</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home/admin/orderHistory">Order History</a>
                            </li>
                            <li>
                                <div class="button-container justify-content-center">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" id="profile-button" role="button">LogOut</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 ">
                        <h4 style="color: #CE7B7A">Order History</h4>
                        <div class="table-responsive ">
                            <table class="table text-white text-center" style="background-color: #D77784">
                                <thead>
                                    <tr>
                                        <th>ID Order</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Tanggal Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartData as $product)
                                        <tr>
                                            <td>{{ $product['id'] }}</td>
                                            <td>{{ $product['user']->name }}</td>
                                            <td>{{ $product['product']->productName }}</td>
                                            <td>{{ $product['qty'] }}</td>
                                            <td>{{ $product['totalPrice'] }}</td>
                                            <td>{{ $product['tglOrder'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
