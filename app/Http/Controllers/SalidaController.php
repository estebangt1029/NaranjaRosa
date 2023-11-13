<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use PDF;
use Excel;
use App\Exports\SalidasExport;

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
            // 'cantidad' => 'required',
            's' => 'required',
            'm' => 'required',
            'l' => 'required',
            'xl' => 'required',
            'xxl' => 'required',
            'cliente' => 'required',
            'product_id' => 'required',
        ]);
    
        // Obtener el producto
        $producto = Product::find($request->product_id);
    
        $cantidadTotal = $request->s + $request->m + $request->l + $request->xl + $request->xxl;

        // Verificar que la cantidad total sea al menos 1
        if ($cantidadTotal < 1) {
            $entrada = Product::all();
            $errores = 'La cantidad total debe ser al menos 1';
            return Inertia::render('entradas/create', ['errores' => $errores, 'entrada' => $entrada]);
        }
        // Verificar si el producto existe y si la cantidad solicitada no es mayor que la cantidad disponible
        if ($cantidadTotal > 0 && $producto && $request->s <= $producto->s && $request->m <= $producto->m && $request->l <= $producto->l && $request->xl <= $producto->xl && $request->xxl <= $producto->xxl) {
            $salida = new Salida;
            $salida->fecha = $request->fecha;
            $salida->hora = $request->hora;
            $salida->cantidad = $cantidadTotal;
            $salida->s = $request->s;
            $salida->m = $request->m;
            $salida->l = $request->l;
            $salida->xl = $request->xl;
            $salida->xxl = $request->xxl;

            $salida->cliente = $request->cliente;
            $salida->product_id = $request->product_id;
            $salida->save();
    
            // Actualizar la cantidad del producto
            // $producto->cantidad -= $request->cantidad;
            $producto->cantidad -= $cantidadTotal;
            $producto->s -= $request->s;
            $producto->m -= $request->m;
            $producto->l -= $request->l;
            $producto->xl -= $request->xl;
            $producto->xxl -= $request->xxl;
            $producto->save();
    
            return redirect()->route('salidas.index');
        } else {
            if($request->s > $producto->s){
                $productos = Product::all();
                $errorS='La cantidad solicitada es mayor que la cantidad disponible';
                return Inertia::render('salidas/create', ['errorS' => $errorS,'productos' => $productos]);
            }
            if($request->m > $producto->m){
                $productos = Product::all();
                $errorm='La cantidad solicitada es mayor que la cantidad disponible';
                return Inertia::render('salidas/create', ['errorm' => $errorm,'productos' => $productos]);
            }
            if($request->l > $producto->l){
                $productos = Product::all();
                $errorl='La cantidad solicitada es mayor que la cantidad disponible';
                return Inertia::render('salidas/create', ['errorl' => $errorl,'productos' => $productos]);
            }
            if($request->xl > $producto->xl){
                $productos = Product::all();
                $errorxl='La cantidad solicitada es mayor que la cantidad disponible';
                return Inertia::render('salidas/create', ['errorxl' => $errorxl,'productos' => $productos]);
            }
            if($request->xxl > $producto->xxl){
                $productos = Product::all();
                $errorxxl='La cantidad solicitada es mayor que la cantidad disponible';
                return Inertia::render('salidas/create', ['errorxxl' => $errorxxl,'productos' => $productos]);
            }
            if($salida->cantidad <= 1){
                $productos = Product::all();
                $error='La salida debe tener almenos un valor';
                return Inertia::render('salidas/create', ['error' => $error,'productos' => $productos]);
            }
            
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

    public function generatePDF()
    {
        $salidas = Salida::all();

        $pdf = PDF::loadView('pdf.salidas', ['salidas' => $salidas]);

        return $pdf->download('salidas.pdf');
    }

    public function generateEXCEL()
    {
        return Excel::download(new SalidasExport(), 'salidas.xlsx');
    }
}
