<!DOCTYPE html>
<html>
<head>
    <title>Lista de Entradas</title>
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

    <h2>Lista de Entradas</h2>

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
            @foreach ($entradas as $index => $entrada)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $entrada->fecha }}</td>
                    <td>{{ $entrada->hora }}</td>
                    <td>{{ $entrada->cantidad }}</td>
                    <td>{{ $entrada->s }}</td>
                    <td>{{ $entrada->m }}</td>
                    <td>{{ $entrada->l }}</td>
                    <td>{{ $entrada->xl }}</td>
                    <td>{{ $entrada->xxl }}</td>
                    <td>{{ $entrada->product_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
