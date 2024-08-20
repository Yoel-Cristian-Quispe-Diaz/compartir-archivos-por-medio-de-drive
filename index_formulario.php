
<!-- cerrar ventana -->
<!-- <html>
<script>
            window.close(); // Cierra la pestaña actual

</script>
</html>
 -->
<?php
$mysqli= new mysqli("localhost","root","","archivos_subidos");
// recordatorio: escribir bien el codigo, no confiarse con el autocompletado de la ia
include 'google_api/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=compartir-archivos-php-abf490d828df.json');
$client=new Google\Client();
$client->useApplicationDefaultCredentials();
$client-> SetScopes(["https://www.googleapis.com/auth/drive.file"]);
try{
$service= new  Google\Service\Drive($client);
$archivo_subido=$_FILES['archivo']['tmp_name'];
$file=new Google\Service\Drive\DriveFile();


$name=$_FILES['archivo']['name'];

$file->SetName($name);
$info= finfo_open(FILEINFO_MIME_TYPE);
$tipo=finfo_file($info, $archivo_subido);


$file->SetParents(array("1sqYfBW485V2Zm20sccoJD9uR2CZZcsXV"));
$file->SetDescription("Archivo Subido");
$file->SetMimeType($tipo);



$enviar=$service->files->create(
    $file,
    array(
        'data' => file_get_contents($archivo_subido),
        'mimeType' =>$tipo,
        'uploadType'=>'media'
    )

);

// SE AÑADE ALA BASE DE DATOS
$ruta="http://drive.google.com/open?id=".$enviar->id;
$sql="INSERT INTO archivos(nombre, Ruta, Extension) VALUES ('$name','$ruta', '$tipo')";

$mysqli-> query($sql);
// echo $sql;

echo '<a href="'. $ruta.    '"target="_blank">'.$enviar->name.'</a>';
}catch(Google_Service_Exception $gs){
    $mensaje=json_decode($gs->getMessage());
    echo $mensaje->error->message();

}catch(Exception $e){
echo $e->getMessage();
}

?>