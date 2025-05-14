<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::orderByDesc('id')->paginate(10);  
        $total = Product::count();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product list retrieved successfully',
                'data' => $products
            ]);
        }

        return view('admin.products.list', [
            "products" => $products,
            'total' => $total,
            'page' => $request->page ?? 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::all();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Form data loaded',
                'data' => $categories
            ]);
        }

        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20000',
            'price' => 'required|string|max:100',
            'description' => 'required|string|max:100',
            'stock' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => []
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $product = new Product();
        $product->name = $request->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->category_id = $request->category;
        $product->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
                'data' => []
            ], 404);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product retrieved successfully',
                'data' => $product
            ]);
        }

        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Edit data loaded',
                'data' => $product
            ]);
        }

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::channel('product')->info('Update request received', ['request' => $request->all()]);   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'price' => 'required|string|max:200',
            'description' => 'required|string|max:100',
            'stock' => 'required|string|max:100',
        ]);


        if ($validator->fails()) {

            Log::channel('product')->info("Validation failed ");
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => []
                ], 422);
            }

            return back()->withErrors($validator)->withInput();
        }

        Log::channel('product')->info("Validation Passed ");

        $product = Product::find($id);
        if (!$product) {
            
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        $product->name = $request->name;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->save();

        Log::channel('product')->info("Product  update thay gai che  ");


        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        }

        Log::channel('product')->info("Products na page ma redirect karyu",);

        return redirect()->route('products.index')->with('success', 'Product updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Product deleted successfully',
                'data' => []
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted Successfully.');
    }
}
