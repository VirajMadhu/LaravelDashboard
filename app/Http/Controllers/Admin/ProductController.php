<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function edit(Products $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Products $product)
    {
        $validated = $request->validate(['name' => ['required'], 'price' => ['required']]);
        $product->update($validated);
        return to_route('admin.products.index')->with('message', 'Product Updated');
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return back()->with('message', 'Product Deleted');
    }

    public function store(Request $request)
    {
        $validate = $request->validate(['name' => ['required'], 'price' => ['required']]);
        Products::create($validate);
        return to_route('admin.products.index')->with('message', 'Product Added Sucessfully!');
    }
}