<?php
session_start();

if (!empty($_POST['Correo'] AND !empty($_POST['Password']))){ //si los datos no son nulos
    
    /*Parametros recibidos del formulario*/
    $Correo = $_POST['Correo'];
    $Password = hash('sha3-512', $_POST['Password']);

/* ============== CONSUMO DE WEB SERVICE ============== */
    // Consumir el servicio GET para obtener un usuario por correo
    $Consultar = file_get_contents("http://localhost/sandovalpenaluisenriqueUnidad3/API/web-service.php?correo=$Correo");
    $dataUser = json_decode($Consultar, true); //respuesta obtenida en JSON
/* ==================================================== */
    
    if ($dataUser) { /*Si el usuario Existe*/
        $PasswordReal = $dataUser[0]['password']; //trae la contraseña guardada en la BD
        
        if ($PasswordReal == $Password) { //si las contraseña ingresada es igual a la registrada en la BD
            $response = 1;
            $_SESSION['Cuenta_Activa'] = $dataUser[0]['correo'];
        } else {
            $response = 0;
        }
    } else { /*Si el usuario no Existe*/
        $response = 0;
    }

} else {
    $response = 2;
}

echo $response;
?>