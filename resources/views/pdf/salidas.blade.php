<!DOCTYPE html>
<html>
<head>
    <title>Lista de Salidas</title>
    <style>
        /* Estilos CSS para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Lista de Salidas</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cantidad</th>
                <th>S</th>
                <th>M</th>
                <th>L</th>
                <th>Xl</th>
                <th>XXL</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salidas as $index => $salida)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $salida->fecha }}</td>
                    <td>{{ $salida->hora }}</td>
                    <td>{{ $salida->cantidad }}</td>
                    <td>{{ $salida->s }}</td>
                    <td>{{ $salida->m }}</td>
                    <td>{{ $salida->l }}</td>
                    <td>{{ $salida->xl }}</td>
                    <td>{{ $salida->xxl }}</td>
                    <td>{{ $salida->product_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
