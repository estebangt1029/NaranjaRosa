<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use PDF;
use Excel;
use App\Exports\ProductsExport;


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
            $existingProduct = Product::where('referencia', $request->referencia)->first();

            if($existingProduct){
                $productos = Product::all();
                $error='Esta referencia ya existe';
                return Inertia::render('products/create', ['error' => $error,'productos' => $productos]);
            }
            if ($request->nombre != '' && $request->referencia != '' && $request->s != '' && $request->m != '' && $request->l != '' && $request->xl != '' && $request->xxl != '' && $request->stock != '') {
                $request->validate([
                    'referencia'=>'required',
                    'nombre'=>'required',
                    // 'cantidad'=>'required',
                    's'=>'required',
                    'm'=>'required',
                    'l'=>'required',
                    'xl'=>'required',
                    'xxl'=>'required',
                    'stock'=>'required',
                    // 'user_id' => 'required'
                ]);
                // Calcular la cantidad total
                $cantidadTotal = $request->s + $request->m + $request->l + $request->xl + $request->xxl;

                // Verificar que la cantidad total sea al menos 1
                if ($cantidadTotal < 1) {
                    $productos = Product::all();
                    $errores = 'La cantidad total debe ser al menos 1';
                    return Inertia::render('products/create', ['errores' => $errores, 'productos' => $productos]);
                }

                // Crear el nuevo producto
                $product = new Product;
                $product->referencia = $request->referencia;
                $product->nombre = $request->nombre;
                $product->cantidad = $cantidadTotal;
                $product->s = $request->s;
                $product->m = $request->m;
                $product->l = $request->l;
                $product->xl = $request->xl;
                $product->xxl = $request->xxl;
                $product->stock = $request->stock;
                $product->save();

                return redirect()->route('products.index');
            }else{
                $productos = Product::all();
                $errores='Todos los campos son obligatorios';
                return Inertia::render('products/create', ['errores' => $errores,'productos' => $productos]);
            }

            
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
            // 'cantidad' => 'required',
            's' => 'required',
            'm' => 'required',
            'l' => 'required',
            'xl' => 'required',
            'xxl' => 'required',
            'stock' => 'required',
        ]);

        // Actualiza los datos de la entrada
        $product->referencia = $request->referencia;
        $product->nombre = $request->nombre;
        $product->cantidad = $request->s+$request->m+$request->l+$request->xl+$request->xxl;
        $product->s = $request->s;
        $product->m = $request->m;
        $product->l = $request->l;
        $product->xl = $request->xl;
        $product->xxl = $request->xxl;
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

    public function generatePDF()
    {
        $products = Product::all();

        $pdf = PDF::loadView('pdf.productos', ['products' => $products]);

        return $pdf->download('productos.pdf');
    }

    public function generateEXCEL()
    {
        return Excel::download(new ProductsExport(), 'productos.xlsx');
    }
}