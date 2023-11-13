<?php
session_start();

if (!empty($_POST['RegistroNombre']) AND !empty($_POST['RegistroCorreo']) AND !empty($_POST['RegistroPassword']) AND !empty($_POST['RegistroPassword-Confirm'])){ //si los datos no son nulos
    $Nombre = $_POST['RegistroNombre'];
    $Correo = $_POST['RegistroCorreo'];
    $Password = hash('sha3-512', $_POST['RegistroPassword']);
    $Password_Confirm = hash('sha3-512', $_POST['RegistroPassword-Confirm']);
    
    if ($Password == $Password_Confirm){ //si las contraseñas son iguales

/* ============== CONSUMO DE WEB SERVICE ============== */
    // Consumir el servicio GET para obtener un usuario por correo
    $Consultar = file_get_contents("http://localhost/API/web-service.php?correo=$Correo");
    $dataUser = json_decode($Consultar, true);
/* ==================================================== */

        if ($dataUser) {
            $response = 0;
        } else {
            /*guarda su foto en la carpeta*/
            $carpeta = "Usuariosft/";
            if (empty($_FILES['RegistroFoto']['name'])) {
                $nombreArchivo = 'unknow.jpg';
            } else {
                $nombreArchivo = $Correo . "_" . basename($_FILES["RegistroFoto"]["name"]);
            }
            $rutaArchivo = $carpeta . $nombreArchivo;
            move_uploaded_file($_FILES["RegistroFoto"]["tmp_name"], $rutaArchivo);
            
/* ============== CONSUMO DE WEB SERVICE ============== */
            // Datos del nuevo usuario
            $data = [
                'nombre' => $Nombre,
                'imagen' => $rutaArchivo,
                'correo' => $Correo,
                'password' => $Password,
            ];

            // Configurar opciones de la solicitud POST
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($data),
                ],
            ];

            // Crear contexto para la solicitud
            $context = stream_context_create($options);
            
            // Enviar la solicitud POST para registrar el nuevo usuario
            $Registrar = file_get_contents('http://localhost/API/web-service.php', false, $context);
            
            // Verificar la respuesta del servidor
            if ($Registrar === false) { //si no se hace el registro
                $response = 4;
            } else {
                $response = 1;
                $_SESSION['Cuenta_Activa'] = $Correo;
            }
/* ==================================================== */

        }

    } else {
        $response = 2;
    }
} else {
    $response = 3;
}

echo $response;
?>