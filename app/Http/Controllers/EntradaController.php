<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use PDF;
use Excel;
use App\Exports\EntradasExport;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entrada::all();
        return Inertia::render('entradas/index', ['entradas' => $entradas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Product::all();
        
        return Inertia::render('entradas/create', [
            'productos' => $productos, // Pasa los productos a la vista
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $request->validate([
            'fecha'=>'required',
            'hora'=>'required',
            // 'cantidad'=>'required',
            's'=>'required',
            'm'=>'required',
            'l'=>'required',
            'xl'=>'required',
            'xxl'=>'required',
            'product_id'=>'required',
        ]);

        $cantidadTotal = $request->s + $request->m + $request->l + $request->xl + $request->xxl;

        // Verificar que la cantidad total sea al menos 1
        if ($cantidadTotal < 1) {
            $entrada = Product::all();
            $errores = 'La cantidad total debe ser al menos 1';
            return Inertia::render('entradas/create', ['errores' => $errores, 'entrada' => $entrada]);
        }

        if ($request->product_id == '') {
            $entrada = Product::all();
            $errores = 'Debe elegir un producto';
            return Inertia::render('entradas/create', ['errores' => $errores, 'entrada' => $entrada]);
        }

        $entrada=new Entrada;
        $entrada->fecha=$request->fecha;
        $entrada->hora=$request->hora;
        $entrada->cantidad = $cantidadTotal;
        $entrada->s=$request->s;
        $entrada->m=$request->m;
        $entrada->l=$request->l;
        $entrada->xl=$request->xl;
        $entrada->xxl=$request->xxl;
        $entrada->product_id = $request->product_id;
        $entrada->save();

        // Actualizar la cantidad del producto
        $producto = Product::find($request->product_id);
        if ($producto) {
            $producto->cantidad = $cantidadTotal;
            $producto->s+=$request->s;
            $producto->m+=$request->m;
            $producto->l+=$request->l;
            $producto->xl+=$request->xl;
            $producto->xxl+=$request->xxl;
            $producto->save();
        }

        return redirect()->route('entradas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        $productos = Product::all();
        return Inertia::render('entradas/show', [
            'entrada' => $entrada,
            'productos' => $productos,
        ]);
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
    public function update(Request $request, Entrada $entrada)
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
            'product_id' => 'required',
        ]);

        // Actualiza los datos de la entrada
        $entrada->fecha = $request->fecha;
        $entrada->hora = $request->hora;
        $entrada->cantidad = $request->cantidad;
        $entrada->product_id = $request->product_id;
        $entrada->save();

        

        return redirect()->route('entradas.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        $entrada->delete();
        return redirect()->route('entradas.index');
    }

    public function generatePDF()
    {
        $entradas = Entrada::all();

        $pdf = PDF::loadView('pdf.entradas', ['entradas' => $entradas]);

        return $pdf->download('entradas.pdf');
    }

    public function generateEXCEL()
    {
        return Excel::download(new EntradasExport(), 'entradas.xlsx');
    }
}
