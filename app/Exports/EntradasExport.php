<?php

// app/Exports/ProductsExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Entrada;

class EntradasExport implements FromQuery, WithHeadings
{
    // La fecha específica que deseas excluir
    private $excludedDate = '2023-11-13T15:22:23.000000Z';

    public function query()
    {
        // Obtén los productos que no tienen la fecha específica
        return Entrada::where('created_at', '!=', $this->excludedDate)
            ->select('id', 'fecha', 'hora', 'cantidad', 's', 'm', 'l', 'xl', 'xxl', 'product_id');
    }

    public function headings(): array
    {
        // Nombres de los campos en el archivo Excel
        return [
            'ID',
            'Fecha',
            'Hora',
            'Cantidad',
            'S',
            'M',
            'L',
            'XL',
            'XXL',
            'Producto',
        ];
    }
}
