<!DOCTYPE html>
<html>
<head>
    <title>Listado de Productos</title>
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

    <h2>Lista de Productos</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>S</th>
                <th>M</th>
                <th>L</th>
                <th>XL</th>
                <th>XXL</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->referencia }}</td>
                    <td>{{ $product->nombre }}</td>
                    <td>{{ $product->cantidad }}</td>
                    <td>{{ $product->s }}</td>
                    <td>{{ $product->m }}</td>
                    <td>{{ $product->l }}</td>
                    <td>{{ $product->xl }}</td>
                    <td>{{ $product->xxl }}</td>
                    <td>{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
