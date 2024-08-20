<!DOCTYPE html>
<html>
<head>
    <title>Carga y descarga de archivos</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h1>Carga y descarga de archivos</h1>
<h2>Carga de archivos</h2>
<form id="miFormulario" enctype="multipart/form-data">
    <input type="file" name="archivo" id="archivo">
    <button type="button" id="cargarBoton">Cargar</button>
</form>

<div id="respuestaDiv">
    <!-- Aquí se mostrará la respuesta del servidor -->
</div>

<script>
    $(document).ready(function() {
        $("#cargarBoton").click(function() {
            var formData = new FormData($("#miFormulario")[0]);
            
            $.ajax({
                url: "/proyecto_f/index_formulario.php",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#respuestaDiv").html(response);
                }
            });
        });
    });
</script>

</body>
</html>
