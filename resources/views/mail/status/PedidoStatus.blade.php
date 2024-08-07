<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de status del pedido. HHGLOBAL</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            position: relative;
        }

        .inner-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            text-align: justify; /* Justifica el texto en el contenedor */
        }

        .inner-container b {
            display: block;
            text-align: left; /* Alinea el texto en negrita a la izquierda */
            margin: 10px 0; /* Agrega un margen vertical para separación */
        }

        .btn-container {
            text-align: center; /* Centra el botón en el contenedor */
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .bpms-legend {
            text-align: center; /* Centra el texto en el pie de página */
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            line-height: 1.5em;
            margin-top: 20px;
            color: #b0adc5;
            font-size: 12px;
        }

        /* Fondo azul detrás del contenedor */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(241, 241, 241);
            z-index: -1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inner-container">
            <h1>¡Buen día, {{ $receptor }}!</h1>
            <p>El pedido "{{ $nameProduct }}", ha cambiado de status a:</p>
            <b>{{ $status }}</b>
            <div class="btn-container">
                <a href="{{ $url }}" class="btn btn-primary">Ver Pedido</a>
            </div>
        </div>
        <div class="bpms-legend">
            HHGLOBAL. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
