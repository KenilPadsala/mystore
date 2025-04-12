<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();
        return view('products.list', ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
            'price' => 'required|string|max:10',
            'description' => 'required|string|max:10',
            'stock' => 'required|string|max:10',
        ]);

        $product = new product();
        $product->name = $request->name;
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('products', 'public');
        //     $product->image = $imagePath;
        // }

        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product Added Successfully.');

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

        $product = product::find($id);
        return view('products.edit', ['product' => $product]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:10',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'price' => 'required|string|max:20',
            'description' => 'required|string|max:10',
            'stock' => 'required|string|max:10',
            ]);

        $product = product::find($id);

        $product->name = $request->name;

        // if ($request->hasFile('image')) {

        //     if ($product->image) {
        //         if (Storage::disk('public')->exists($product->image)) {
        //             Storage::disk('public')->delete($product->image);
        //         }
        //     }
        //     $imagePath = $request->file('image')->store('products', 'public');
        //     $product->image = $imagePath;

        // }

        $product->price = $request->price;
        $product->description = $request->description;  
        $product->stock = $request->stock;

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated Successfully.');
        ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = product::find($id);

        // if ($product->image) {
        //     if (Storage::disk('public')->exists($product->image)) {
        //         Storage::disk('public')->delete($product->image);
        //     }
        // }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted Successfully.');
    }
}
