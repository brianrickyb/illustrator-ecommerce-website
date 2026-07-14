<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
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
    .btn-submit {
        background-color: #D77784;
        color: white;
        border: none;
        padding: 7px 14px;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: white;
        color: #D77784;
        border: 1px solid #D77784;
    }

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
    <div class="container d-flex flex-column align-items-center" style="color: #CE7B7A">
        <h4>Create New Product</h4>
        @if ($errors)
            <ul style="color: red; list-style:none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="form-container">
            <form action="/admin" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    Category:
                    <input type="text" name="category" class="form-control" id="category"><br>
                </div>
                <div class="form-group">
                    Product Name:
                    <input type="text" name="productName" class="form-control" id="productName"><br>
                </div>
                <div class="form-group">
                    Description:
                    <textarea name="description" id="" cols="30" rows="10" class="form-control" id="keterangan"></textarea><br>
                </div>
                <div class="form-group">
                    Price:
                    <input type="text" name="price" class="form-control" id="price"><br>
                </div>
                <div class="form-group">
                    Photo Product:
                    <input type="file" name="photo" class="form-control" id="photo"><br>
                </div>
                <div class="form-group">
                    Photo Preview:
                    <input type="file" name="photoPreview[]" class="form-control" id="photo" multiple><br>
                </div>
                <div class="form-group">
                    Photo Progress:
                    <input type="file" name="photoProgress[]" class="form-control" id="photo" multiple><br>
                </div>
                <div class="button-container-submit mb-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
