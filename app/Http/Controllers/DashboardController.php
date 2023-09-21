<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Entrada;
use App\Models\Salida;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::count();
        $salidas = Salida::count();
        $entradas = Entrada::count();
        
    
        return Inertia::render('Dashboard', [
            'totalProducts' => $products,
            'totalEntradas' => $entradas,
            'totalSalidas' => $salidas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Salida $salida)
    {
       
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

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salida $salida)
    {

    }
}
