<?php
include 'google_api/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=compartir-archivos-php-abf490d828df.json');
$client=new Google\Client();
$client->useApplicationDefaultCredentials();
$client-> SetScopes(["https://www.googleapis.com/auth/drive.file"]);

$service=new Google\Service\Drive($client);
$resultado= $service->files->listFiles();
$contador=1;
foreach ($resultado as $elemen) {
    $ruta="http://drive.google.com/open?id=".$elemen->id;
    echo '<a href="'. $ruta.    '"target="_blank">'.$contador.".-".$elemen->name.'</a>   <br />';
    $contador++;
}

?>