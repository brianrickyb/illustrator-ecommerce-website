<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Start Shopping Cart Controller
     */
    public function index()
    {
        if (Auth::check()) {
            $userID = Auth::id();
            $shoppingCart = ShoppingCart::where('idUser', $userID)->where('deleted_at', null)->get();

            $idProducts = $shoppingCart->pluck('idProduct')->toArray();

            // Use 'whereIn' to retrieve all products in a single query
            $items = Product::whereIn('id', $idProducts)->get();

            $cartData = [];
            foreach ($items as $item) {
                // Find the corresponding ShoppingCart record
                $cartRecord = $shoppingCart->firstWhere('idProduct', $item->id);

                // Get the quantity from the ShoppingCart record
                $qty = $cartRecord ? $cartRecord->qty : 0;
                // Build an array with product and quantity information
                $cartData[] = [
                    'idProduct' => $item->id,
                    'product' => $item,
                    'qty' => $qty,
                    'photoUrl' => Storage::url($item->photo),
                    'description' => $item->description,
                    'category' => $item->category,
                    'price' => $item->price,
                ];
            }
            return view('user.shopping-cart', ['cartData' => $cartData]);
        }
    }

    public function shopping_cart(Request $request)
    {
        $idProduct = $request->buttonBeli;
        $product = Product::findOrFail($idProduct);
        $photos = Storage::url($product->photo);
        return view('user.shopping-cart', ['product' => $product, 'photos' => $photos]);
    }

    public function store(Request $request)
    {
        if (Auth::id()) {
            $idUser = Auth::id();
            $idProduct = $request->buttonBeli;
            $product = Product::findOrFail($idProduct);
            if (ShoppingCart::where('idUser', $idUser)->where('idProduct', $idProduct)->count() > 0) {
                $shoppingCart = ShoppingCart::where('idUser', $idUser)->where('idProduct', $idProduct)->get();
                foreach ($shoppingCart as $shoppingCart) {
                    if (isset($request->qty)) {
                        $quantity = $request->qty;
                    } else {
                        $quantity = 1;
                    }
                    $shoppingCart->qty = $shoppingCart->qty + $quantity;
                    $shoppingCart->totalPrice = $product->price * $shoppingCart->qty;
                }
            } else {
                if (isset($request->qty)) {
                    $quantity = $request->qty;
                } else {
                    $quantity = 1;
                }

                $totalPrice = $quantity * $product->price;

                $shoppingCart = new ShoppingCart();
                $shoppingCart->idUser     = $idUser;
                $shoppingCart->idProduct  = $idProduct;
                $shoppingCart->qty        = $quantity;
                $shoppingCart->totalPrice = $totalPrice;
            }
            $shoppingCart->save();
            return redirect('/home/shop');
        }
    }

    public function update(Request $request)
    {
        if (Auth::id()) {
            $idUser = Auth::id();
            $productID = $request->btnProductID;

            $product = Product::findOrFail($productID);


            $shoppingCart = ShoppingCart::where('idUser', $idUser)->where("idProduct", $productID)->get();

            foreach ($shoppingCart as $shoppingCart) {
                $shoppingCart->qty = $shoppingCart->qty + 1;
                $shoppingCart->totalPrice += $product->price;
            }

            $shoppingCart->save();
        }
        return redirect('/home/shopping-cart');
    }

    public function destroy(Request $request)
    {
        if (Auth::id()) {
            $idUser = Auth::id();
            $productID = $request->btnProductID;

            $product = Product::findOrFail($productID);

            $shoppingCart = ShoppingCart::where('idUser', $idUser)->where("idProduct", $productID)->get();
            foreach ($shoppingCart as $shoppingCart) {
                if ($shoppingCart->qty > 1) {
                    $shoppingCart->qty = $shoppingCart->qty - 1;
                    $shoppingCart->totalPrice -= $product->price;
                    $shoppingCart->save();
                } else {
                    $shoppingCart->forceDelete();
                }
            }
        }
        return redirect('/home/shopping-cart');
    }
    /**
     * End Shopping Cart Controller
     */


    /**
     * Start Shop Page Controller
     */
    public function shop()
    {
        if (Auth::id()) {
            $products = Product::all();
            // $photos = Storage::url($products->photo);
            $photos = [];
            foreach ($products as $product) {
                // Assuming 'photo' is the attribute containing the photo's filename
                $photoUrl = Storage::url($product->photo);
                // Add the URL to the $photos array
                $photos[] = $photoUrl;
            }
            return view('user.shop', ['products' => $products, 'photos' => $photos]);
        } else {
            $products = Product::all();
            // $photos = Storage::url($products->photo);
            $photos = [];
            foreach ($products as $product) {
                // Assuming 'photo' is the attribute containing the photo's filename
                $photoUrl = Storage::url($product->photo);
                // Add the URL to the $photos array
                $photos[] = $photoUrl;
            }
            return view('user.shop', ['products' => $products, 'photos' => $photos]);
        }
    }
    /**
     * End Shop Page Controller
     */


    /**
     * Start Home Product Detail Page Controller
     */
    public function homeproductDetail($id)
    {
        $product = Product::findOrFail($id);

        // Generate URLs for the main photo and store them in an array
        $photos = Storage::url($product->photo);

        // Generate URLs for each photo progress and store them in an array
        $photoProgress = [];
        foreach ($product->photoProgress as $progress) {
            $photoProgress[] = Storage::url($progress);
        }

        return view('user.homeproductdetail', [
            'product' => $product,
            'photos' => $photos,
            'photoProgress' => $photoProgress
        ]);
    }
    /**
     * End Home Product Detail Page Controller
     */


    /**
     * Start Shop Product Detail Page Controller
     */
    public function shopproductDetail($id)
    {
        $product = Product::findOrFail($id);
        // Generate URLs for the main photo and store them in an array
        $photoPreview = [];
        foreach ($product->photoPreview as $preview) {
            $photoPreview[] = Storage::url($preview);
        }
        return view('user.shopproductdetail', [
            'product' => $product,
            'photoPreview' => $photoPreview,
            // 'photoProgress' => $photoProgress
        ]);
    }
    /**
     * End Shop Product Detail Page Controller
     */


    /**
     * Start Profile Page Controller
     */
    public function profileuser()
    {
        $userID = Auth::id();
        $userProfile = User::findOrFail($userID);
        return view('user.profile', ['user' => $userProfile]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'socialMedia' => 'required',
            'address' => 'required',
            'country' => 'required', // Adjust the max file size as needed
            'postalCode' => 'required',
            'phoneNumber' => 'required',
        ]);

        $newProfile = $request;
        $userID = Auth::id();
        $userProfile = User::findOrFail($userID);

        $userProfile->name = $newProfile->name;
        $userProfile->email = $newProfile->email;
        $userProfile->socialMedia = $newProfile->socialMedia;
        $userProfile->address = $newProfile->address;
        $userProfile->country = $newProfile->country;
        $userProfile->postalCode = $newProfile->postalCode;
        $userProfile->phoneNumber = $newProfile->phoneNumber;
        $userProfile->save();

        return view('user.profile', ['user' => $userProfile]);
    }

    /**
     * End Profile Page Controller
     */


    /**
     * Start Commission Page Controller
     */
    public function commission()
    {
        return view('user.commission');
    }
    /**
     * End Commission Page Controller
     */


    /**
     * Start About Page Controller
     */
    public function about()
    {
        return view('user.about');
    }
    /**
     * End About Page Controller
     */


    /**
     * Start Thankyou Page Controller
     */
    public function thanks()
    {
        Mail::to('hello.ireneparamitha@gmail.com')->send(new SendEmail());
        $userID = Auth::id();
        ShoppingCart::where('idUser', $userID)->delete();

        return view('user.thankyou');
    }
    /**
     * End Thankyou Page Controller
     */






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo 'create';
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $product = Product::findOrFail($id);

        // return view('dashboard', ['product' => $product, 'photos' => $photos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
