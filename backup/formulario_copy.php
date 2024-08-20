<!DOCTYPE html>
<html>
<head>
    <title>Carga y descarga de archivos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            margin: 0;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            text-align: center;
        }

        h2 {
            margin: 20px 0 10px;
        }

        form {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        input[type="file"] {
            margin-right: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background-color: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 5px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        #contenidoDiv {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            background-color: #fff;
        }

        button {
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
    </style>
</head>



<body>
<body>
    <!-- Tu formulario de carga de archivos -->
    <form id="formularioCarga" enctype="multipart/form-data">
        <input type="file" name="archivo" id="archivo">
        <input type="submit" value="Cargar" name="submit">
    </form>

    <!-- Div para mostrar el resultado -->
    <div id="resultadoDiv"></div>

    
    <div id="contenidoDiv"></div>
    <button id="cargarContenido">Cargar Contenido</button>

    <script>
        $(document).ready(function() {


            $("#cargarContenido").click(function() {
                $.ajax({
                    url: "listar.php", // Ruta al archivo PHP
                    method: "GET",
                    success: function(response) {
                        $("#contenidoDiv").html(response); // Insertar respuesta en el div
                    }
                });
            });

        });
    </script>
</body>
</html>
