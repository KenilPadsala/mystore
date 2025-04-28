<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category list retrieved successfully',
                'data' => $categories
            ]);
        }

        return view('categories.list', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category form data loaded',
                'data' => []
            ]);
        }

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:10',
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

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category Added Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
                'data' => []
            ], 404);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category retrieved successfully',
                'data' => $category
            ]);
        }

        return redirect()->route('categories.index')->with('error', 'Category not found.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Edit data loaded',
                'data' => $category
            ]);
        }

        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:10',
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

        $category = Category::find($id);

        if (!$category) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        $category->name = $request->name;
        $category->save();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found',
                    'data' => []
                ], 404);
            }

            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }

        $category->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully',
                'data' => []
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted Successfully.');
    }
}
