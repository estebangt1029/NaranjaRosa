<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('products/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('products/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'referencia'=>'required',
            'nombre'=>'required',
            'cantidad'=>'required',
            'stock'=>'required',
            // 'user_id' => 'required'
        ]);
        $product=new Product;
        $product->referencia=$request->referencia;
        $product->nombre=$request->nombre;
        $product->cantidad=$request->cantidad;
        $product->stock=$request->stock;
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('products/show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'referencia' => 'required',
            'nombre' => 'required',
            'cantidad' => 'required',
            'stock' => 'required',
        ]);

        // Actualiza los datos de la entrada
        $product->referencia = $request->referencia;
        $product->nombre = $request->nombre;
        $product->cantidad = $request->cantidad;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}