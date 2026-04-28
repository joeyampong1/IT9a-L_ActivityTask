<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    // Display all produts
    public function index()
    {
        $products = Product::all();
         return view('product.index', [
            'items' => $products
        ]);

    }
    //  Insert Produt
    public function store (Request $request)
    {
        $request->validate([
            'name123' => 'required',
            'price123' => 'required|numeric',
        ]);

    Product::create([
        'name' => $request->name123,
        'price' => $request->price123,
        ]);   

        return redirect('/products');
    }

    // shows
    public function show($id)
    {
        $product = Product::find($id);
        return redirect()->route('products.edit', $id);
    }
    // edit
    public function edit($id)
    {
         $product = Product::findOrFail($id);
         return view('product.edit', compact('product'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name123'=> 'required',
            'price123'=> 'required',
        ]);
        $product = Product::find($id);
        $product->update([
            'name'=> $request->name123,
            'price'=> $request->price123
        ]);
        return redirect('/products');
    }

    // delete
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }
}