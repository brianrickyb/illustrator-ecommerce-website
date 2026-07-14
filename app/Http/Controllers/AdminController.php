<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.index', ['product' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|in:charms,photocard,artbook,print,Charms,Photochard,Artbook,Print',
            'productName' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
            'photoPreview.*' => 'required|image|mimes:jpg,jpeg,png',
            'photoProgress.*' => 'image|mimes:jpg,jpeg,png',
        ]);


        $photo = $request->file('photo');
        $photoPreview = $request->file('photoPreview');
        $photoProgress = $request->file('photoProgress');

        $ext = $photo->extension();
        if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
            return redirect()->back()->withInput()->withErrors(['photo' => 'The photo must be a jpg, jpeg, or png file.']);
        }
        $path = $request->file('photo')->storePublicly('photos', 'public');

        // Store and associate the preview photos
        $photoPreviewPaths = [];
        foreach ($photoPreview as $file) {
            $extension = $file->extension();
            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->withInput()->withErrors(['photoPreview' => 'One or more photo previews must be a jpg, jpeg, or png file.']);
            }

            $previewPath = $file->storePublicly('photos', 'public');
            $photoPreviewPaths[] = $previewPath;
        }

        $product = new Product();
        $product->category = $request->category;
        $product->productName = $request->productName;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->photo = $path;
        $product->photoPreview = $photoPreviewPaths;

        if ($request->hasFile('photoProgress')) {
            $photoProgressPaths = [];
            foreach ($request->file('photoProgress') as $file) {
                $extension = $file->extension();
                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return redirect()->back()->withInput()->withErrors(['photoProgress' => 'One or more photo progress must be a jpg, jpeg, or png file.']);
                }

                $progressPath = $file->storePublicly('photos', 'public');
                $photoProgressPaths[] = $progressPath;
            }
            $product->photoProgress = $photoProgressPaths;
        }
        // $product->photoProgress = $photoProgressPaths;
        $product->save();
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        // Generate URLs for the main photo and store them in an array
        $photos = Storage::url($product->photo);

        // Generate URLs for each photo preview and store them in an array
        $photoPreviews = [];
        foreach ($product->photoPreview as $preview) {
            $photoPreviews[] = Storage::url($preview);
        }

        // Generate URLs for each photo progress and store them in an array
        $photoProgress = [];
        if ($product->photoProgress != null) {
            foreach ($product->photoProgress as $progress) {
                $photoProgress[] = Storage::url($progress);
            }
        }

        return view('admin.show', [
            'product' => $product,
            'photos' => $photos,
            'photoPreviews' => $photoPreviews,
            'photoProgress' => $photoProgress,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product =  Product::findOrFail($id);
        return view('admin.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => 'in:charms,photocard,artbook,print,Charms,Photochard,Artbook,Print',
            'productName' => '',
            'description' => '',
            'price' => 'numeric',
            'photo' => 'image|mimes:jpg,jpeg,png', // Adjust the max file size as needed
            'photoPreview.*' => 'image|mimes:jpg,jpeg,png',
            'photoProgress.*' => 'image|mimes:jpg,jpeg,png',
        ]);

        $product = Product::where('id', $request->id)
            ->where('id', '!=', $id)
            ->get();
        if ($product->count() > 0) {
            return redirect()->back()->withInput()->withErrors(['id' => 'The id is already taken.']);
        }

        //check photo
        $product = Product::findOrFail($id);
        if ($request->hasFile('photo')) {
            $ext = $request->file('photo')->extension();
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->withInput()->withErrors(['photo' => 'The photo must be a jpg, jpeg, or png file.']);
            }

            $path = $request->file('photo')->storePublicly('photos', 'public');
            $product->photo = $path;
        }

        //check photoPreview
        if ($request->hasFile('photoPreview')) {
            $photoPreviewPaths = [];
            foreach ($request->file('photoPreview') as $file) {
                $extension = $file->extension();
                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return redirect()->back()->withInput()->withErrors(['photoPreview' => 'One or more photo previews must be a jpg, jpeg, or png file.']);
                }

                $previewPath = $file->storePublicly('photos', 'public');
                $photoPreviewPaths[] = $previewPath;
            }
            $product->photoPreview = $photoPreviewPaths;
        }

        //check photoProgress
        if ($request->hasFile('photoProgress')) {
            $photoProgressPaths = [];
            foreach ($request->file('photoProgress') as $file) {
                $extension = $file->extension();
                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    return redirect()->back()->withInput()->withErrors(['photoProgress' => 'One or more photo progress must be a jpg, jpeg, or png file.']);
                }

                $progressPath = $file->storePublicly('photos', 'public');
                $photoProgressPaths[] = $progressPath;
            }
            $product->photoProgress = $photoProgressPaths;
        }

        $product->category = $request->category;
        $product->productName = $request->productName;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        // return 'Berhasil Menyimpan data product dengan id= ' . $product->id;
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/home');
    }

    public function history()
    {
        $shoppingCarts = ShoppingCart::onlyTrashed()->orderBy('deleted_at', 'desc')->get();


        $cartData = [];
        foreach ($shoppingCarts as $shoppingCart) {
            $idProduct = $shoppingCart->idProduct;
            $item = Product::where('id', $idProduct)->first();

            $idUser = $shoppingCart->idUser;
            $user = User::where('id', $idUser)->first();

            if ($item) {
                $cartData[] = [
                    'id' => $shoppingCart->id,
                    'idProduct' => $idProduct,
                    'product' => $item,
                    'user' => $user,
                    'qty' => $shoppingCart->qty,
                    'totalPrice' => $shoppingCart->totalPrice,
                    'tglOrder' => Carbon::parse($shoppingCart->deleted_at)->format('l, jS F Y, h:i:s A'),
                ];
            }
        }


        return view('admin.history', ['cartData' => $cartData]);
    }
}
