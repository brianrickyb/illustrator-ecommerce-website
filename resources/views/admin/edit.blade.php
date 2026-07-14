<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <meta name="robots" content="noindex, nofollow">
    @vite('resources/css/style.css')
    @vite('resources/css/Hero-Clean-images.css')
    @vite('resources/css/bootstrap.min.css')
    @vite('resources/js/bootstrap.min.js')
    @vite('resources/js/bold-and-bright.js')
    @vite('resources/css/home.css')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600&family=Inter:wght@400;500;600&display=swap" />
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
    <div class="admin-form-wrap">
        <h4 class="admin-form-title">Edit Product</h4>
        @if ($errors->any())
            <ul class="admin-form-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="admin-form-card">
            <form action="/admin/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="admin-form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        @foreach (['print', 'photocard', 'charms', 'artbook'] as $option)
                            <option value="{{ $option }}" @selected(strtolower($product->category) === $option)>
                                {{ ucfirst($option) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="admin-form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="productName" id="productName" value="{{ $product->productName }}">
                </div>
                <div class="admin-form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="6">{{ $product->description }}</textarea>
                </div>
                <div class="admin-form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" min="0" step="1" value="{{ $product->price }}">
                </div>
                <div class="admin-form-group">
                    <label for="photo">Photo Product (leave blank to keep current)</label>
                    <input type="file" name="photo" id="photo">
                </div>
                <div class="admin-form-group">
                    <label for="photoPreview">Photo Preview (leave blank to keep current)</label>
                    <input type="file" name="photoPreview[]" id="photoPreview" multiple>
                </div>
                <div class="admin-form-group">
                    <label for="photoProgress">Photo Progress (leave blank to keep current)</label>
                    <input type="file" name="photoProgress[]" id="photoProgress" multiple>
                </div>
                <button type="submit" class="admin-form-submit">Save</button>
            </form>
        </div>
    </div>
</body>

</html>
