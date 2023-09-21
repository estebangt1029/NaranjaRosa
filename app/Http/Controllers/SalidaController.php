<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salidas = Salida::all();
        return Inertia::render('salidas/index', ['salidas' => $salidas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Product::all();
        
        return Inertia::render('salidas/create', [
            'productos' => $productos, // Pasa los productos a la vista
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'cantidad' => 'required',
            'cliente' => 'required',
            'product_id' => 'required',
        ]);
    
        // Obtener el producto
        $producto = Product::find($request->product_id);
    
        // Verificar si el producto existe y si la cantidad solicitada no es mayor que la cantidad disponible
        if ($producto && $request->cantidad <= $producto->cantidad) {
            $salida = new Salida;
            $salida->fecha = $request->fecha;
            $salida->hora = $request->hora;
            $salida->cantidad = $request->cantidad;
            $salida->cliente = $request->cliente;
            $salida->product_id = $request->product_id;
            $salida->save();
    
            // Actualizar la cantidad del producto
            $producto->cantidad -= $request->cantidad; // Disminuir la cantidad
            $producto->save();
    
            return redirect()->route('salidas.index');
        } else {
            $productos = Product::all();
            $error='La cantidad solicitada es mayor que la cantidad disponible';
            return Inertia::render('salidas/create', ['error' => $error,'productos' => $productos]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Salida $salida)
    {
        $productos = Product::all();
        return Inertia::render('salidas/show', [
            'salida' => $salida,
            'productos' => $productos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salida $salida)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salida $salida)
    {
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'cantidad' => 'required',
            'cliente' => 'required',
            'product_id' => 'required',
        ]);

        // Actualiza los datos de la entrada
        $salida->fecha = $request->fecha;
        $salida->hora = $request->hora;
        $salida->cantidad = $request->cantidad;
        $salida->cliente = $request->cliente;
        $salida->product_id = $request->product_id;
        $salida->save();

        return redirect()->route('salidas.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salida $salida)
    {
        $salida->delete();
        return redirect()->route('salidas.index');
    }
}
