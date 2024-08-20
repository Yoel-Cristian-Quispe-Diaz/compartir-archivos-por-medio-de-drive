<?php

// recordatorio: escribir bien el codigo, no confiarse con el autocompletado de la ia

include 'google_api/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=compartir-archivos-php-abf490d828df.json');
$client=new Google\Client();
$client->useApplicationDefaultCredentials();
$client-> SetScopes(["https://www.googleapis.com/auth/drive.file"]);
try{
$service= new  Google\Service\Drive($client);
$archivo_subido="C:\Users\berna\OneDrive\Imágenes\Álbum de cámara\jin_woo_solo_leveling.jpg";
$file=new Google\Service\Drive\DriveFile();
$file->SetName("mi_primer_archivo");
$file->SetParents(array("1sqYfBW485V2Zm20sccoJD9uR2CZZcsXV"));
$file->SetDescription("Archivo Subido");
$file->SetMimeType("image/jpg");

$enviar=$service->files->create(
    $file,
    array(
        'data' => file_get_contents($archivo_subido),
        'mimeType' =>"image/jpg",
        'uploadType'=>'media'
    )

);
echo '<a href="http://drive.google.com/open?id='.$enviar->id.'"target="_blank">'.$enviar->name.'</a>';
}catch(Google_Service_Exception $gs){
    $mensaje=json_decode($gs->getMessage());
    echo $mensaje->error->message();

}catch(Exception $e){
echo $e->getMessage();
}
?>