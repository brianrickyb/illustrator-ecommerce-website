<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::id()) {
            $role_id = Auth()->user()->role_id;

            if ($role_id == '2') {
                $products = Product::where('photoProgress', '!=', null)->get();
                $photos = [];
                foreach ($products as $product) {
                    // Assuming 'photo' is the attribute containing the photo's filename
                    $photoUrl = Storage::url($product->photo);
                    // Add the URL to the $photos array
                    $photos[] = $photoUrl;
                }
                return view('dashboard', ['products' => $products, 'photos' => $photos]);
            } else if ($role_id == '1') {
                $products = Product::all();
                return view('admin.index')->with('products', $products);
            } else {
                return redirect()->back();
            }
        } else {
            $products = Product::where('photoProgress', '!=', null)->get();
            $photos = [];
            foreach ($products as $product) {
                // Assuming 'photo' is the attribute containing the photo's filename
                $photoUrl = Storage::url($product->photo);
                // Add the URL to the $photos array
                $photos[] = $photoUrl;
            }
            return view('dashboard', ['products' => $products, 'photos' => $photos]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
