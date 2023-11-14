<?php
session_start();

$Correo = $_SESSION['Cuenta_Activa'];

/*guarda su foto en la carpeta*/
$carpeta = "Usuariosft/";
if (empty($_FILES['UpdateFoto']['name'])) {
    $nombreArchivo = 'unknow.jpg';
} else {
    $nombreArchivo = $Correo . "_" . basename($_FILES["UpdateFoto"]["name"]);
}

$rutaArchivo = $carpeta . $nombreArchivo;
move_uploaded_file($_FILES["UpdateFoto"]["tmp_name"], $rutaArchivo);


// Datos que deseas actualizar
$data = [
    'imagen' => $rutaArchivo,
    'correo' => $Correo,
];

// Configurar opciones de la solicitud PUT
$options = [
    CURLOPT_URL => 'http://localhost/API/web-service.php',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => http_build_query($data),
];

// Inicializar cURL y configurar opciones
$curl = curl_init();
curl_setopt_array($curl, $options);

// Ejecutar la solicitud
$respuesta = curl_exec($curl);

// Verificar si la solicitud fue exitosa
if ($respuesta === false) {
    $response = 0;
} else {
    $response = 1;
}

// Cerrar la sesión cURL
curl_close($curl);
echo $response;
?>