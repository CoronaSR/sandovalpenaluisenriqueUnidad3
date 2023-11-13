<?php
session_start();
if (!empty($_SESSION['Cuenta_Activa'])){ //si hay una sesion activa
  //redirige al inicio
  echo '<script>window.location.href = "http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/src/View/inicio.php";</script>';
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Favicon-->
    <link rel="icon" href="http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/webroot/img/DesignAI.png" alt="favicon">
    <!--Title Web-->
    <title>DESIGNAI</title>
    <!-- JQuery Validate library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--Boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed:wght@300&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap');

      /* Diseño del Navbar */
      .navbar{
        background: #000000;
        height: 80px;
        padding: 0px 20px;
        z-index: 1;
      }

      /* Letras del Logo "DESIGNAI" */
      .DESIGN{
        color: #ffffff;
      }.AI{
        color: #59d9de;
      }

      /* Contenedor de la Presentacion */
      .Cont_Principal{
        background: linear-gradient(315deg, #AFF1F2 26%, #d4f9f8 74%);
        padding: 90px 10px 10px;
        height: 100vh;
        display: grid;
        grid-template-columns: 60% 40%;
      }.Cont_Principal .Columna-2{ /*columna derecha*/
        background: #ffffff;
        padding: 20px;
        font-family: 'Encode Sans Condensed', sans-serif;
        flex-direction: column;
      }.Columna-2 .Contenedor{
        width: 100%;
        text-align: center;
      }

      .Cont_Principal .Columna-1{ /*columna izquierda*/
        background: url(https://imagentecpro.com/wp-content/uploads/2021/07/diseno_grafico-publicitario-y-digital.png) no-repeat center;
        background-size: cover;
        flex-direction: column;
        font-family: 'Dancing Script', cursive;
        text-align: center;
      }
      
      /* Clase de inputs */
      .form-control{
        border: 2px solid #1b939f;
      }.form-control:focus{
        border: 2px solid #1DB5BD;
        box-shadow: none;
      }

      /* Diseño del Boton Principal "Entrar/Registrar" */
      .Boton_Principal{
        width: 60%;
        background: #1B939F;
        color: #ffffff;
      }.Boton_Principal:hover{
        background: #205f6a;
        color: #ffffff;
      }

      /* Diseño de Opcion para Cambiar de Formulario */
      .ancla{
        color: #1b939f;
        cursor: pointer;
      }#ancla:hover{
        text-decoration: underline;
      }

      /* Contenedor del Formulario de Registro */
      #Registro{
        display: none;
      }

      .fotoperfil{
        cursor: pointer;
      }.fotoperfil img{
        width: 100px;
        height: 100px;
        border: 2px solid #1b939f;
        border-radius: 50px;
      }

      /* Contenedor de Vista de Error*/
      #Cont_Error{
        display: none;
        width: 100%;
        height: 100vh;
        z-index: 2;
        padding: 90px 10px 10px;
        background: rgba(0, 0, 0, .5);
      }.Alerta{ /*Alerta*/
        height: 15rem;
        width: 30rem;
        border-radius: 10px;
        background: #bfe0e2;
        flex-direction: column;
        font-family: 'Encode Sans Condensed', sans-serif;
      }
    </style>
  </head>
  <body>
    <!--Navbar-->
    <div class="navbar fixed-top">
      <h1><b class="DESIGN">DESIGN</b><b class="AI">AI</b></h1>
    </div>

    <!--Interfaz Error-->
    <div class="align-items-center justify-content-center fixed-top" id="Cont_Error">
      <div class="Alerta d-flex align-items-center justify-content-center shadow">
        <b class="mb-3" id="textAlert">Alerta</b>
        <button class="btn Boton_Principal" id="acept" onclick="closeAlert()"><b>Aceptar</b></button>
      </div>
    </div>

    <!--Contenedor Principal-->
    <div class="Cont_Principal">
      <!--Columna Izquierda-->
      <div class="Columna-1 d-flex align-items-center justify-content-center m-3">
        <h1 class="p-3 bg-dark text-white">Las grandes Ideas son Inteligencia.</h1>
      </div>
      <!--Columna Derecha-->
      <div class="Columna-2 d-flex align-items-center justify-content-center rounded shadow">
        <!-- =========== Contenedor del Formulario de Login =========== -->
        <div class="Contenedor p-2" id="Login">
          <h4 class="mb-4"><b>Iniciar Sesion</b></h4>
          <!--Campo Correo-->
          <input type="e-mail" class="form-control mb-2" id="LoginCorreo" placeholder="Ingresa tu Correo">
          <!--Campo Contraseña-->
          <input type="password" class="form-control mb-3" id="LoginPassword" placeholder="Ingresa tu Contraseña">
          <!--Boton "Iniciar Sesion"-->
          <button type="button" class="btn Boton_Principal mb-3" id="BotonLogin"><b>Entrar</b></button>
          <!--Ir al formulario de Registro-->
          <div>
            <b>¿Aun no tienes cuenta? </b><b class="ancla" onclick="Registrarse()">Registrate</b>
          </div>
        </div>
        <!-- =========== Contenedor del Formulario de Registro =========== -->
        <form method="post" action="" enctype="multipart/form-data" class="Contenedor p-2" id="Registro">
          <h4 class="mb-4"><b>Registro</b></h4>
          <!--Campo Imagen-->
          <label for="RegistroFoto" class="mb-3 fotoperfil">
            <img src="https://i.pinimg.com/474x/3d/27/c1/3d27c1d91548b66bbe4d0610d9515615.jpg" id="PrevisualizacionFoto" src="#" alt="Vista previa">
          </label>
          <input type="file" name="RegistroFoto" id="RegistroFoto" accept=".jpg, .jpeg, .png" style="display: none;">
          <!--Campo Nombre-->
          <input type="text" class="form-control mb-2" name="RegistroNombre" id="RegistroNombre" placeholder="Ingresa tu Nombre">
          <!--Campo Correo-->
          <input type="e-mail" class="form-control mb-2" name="RegistroCorreo" id="RegistroCorreo" placeholder="Ingresa un Correo">
          <!--Campo Contraseña-->
          <input type="password" class="form-control mb-2" name="RegistroPassword" id="RegistroPassword" placeholder="Ingresa una Contraseña">
          <!--Campo Confirmar Contraseña-->
          <input type="password" class="form-control mb-3" name="RegistroPassword-Confirm" id="RegistroPassword-Confirm" placeholder="Repite la Contraseña Contraseña">
          <!--Boton "Registrar"-->
          <button type="button" class="btn Boton_Principal mb-3" id="BotonRegistro"><b>Registrar</b></button>
          <!--Cambiar al formulario de Login-->
          <div>
            <b>¿Ya tienes cuenta? </b><b class="ancla" onclick="Loguearse()">Inicia Sesión</b>
          </div>
        </form>
      </div>
    </div>

    <!--Scripts de Boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--Libreria de Iconos-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!--Script para formularios-->
    <script>
      let ContLogin = document.getElementById('Login');
      let ContRegistro = document.getElementById('Registro');

      //Cambiar al formulario de Registro
      function Registrarse(){
        ContLogin.style.display = 'none';
        ContRegistro.style.display = 'block';
      }

      //Cambiar al formulario de Login
      function Loguearse(){
        ContLogin.style.display = 'block';
        ContRegistro.style.display = 'none';
      }

      // Obtener referencias a los elementos del formulario
      const inputFotoPerfil = document.getElementById('RegistroFoto');
      const fotoPerfil = document.getElementById('PrevisualizacionFoto');
      
      // Escuchar el evento "change" del input de imagen
      inputFotoPerfil.addEventListener('change', function () {
      const archivo = inputFotoPerfil.files[0]; // Obtener el archivo seleccionado
        if (archivo) {
          const reader = new FileReader(); // Crear un lector de archivos
          
          // Cuando se cargue la imagen, mostrarla en la previsualización
          reader.onload = function () {
            fotoPerfil.src = reader.result;
          };
          
          // Leer el archivo como URL
          reader.readAsDataURL(archivo);
        }
      });

      /*Alertas*/
      let cont_Error = document.getElementById('Cont_Error');

      function mensaje_Alerta(mensaje){
        cont_Error.style.display = 'flex';
        $('#textAlert').html(mensaje); 
      }
      /*Cerrar Alerta*/
      function closeAlert(){
        cont_Error.style.display = 'none';
      }
      
      $(document).ready(function() {
        //Enviar los Datos Introducidos en el formulario de Login
        $('#BotonLogin').click(function() {
          /*Credenciales de Acceso*/
          var L_Correo = $('#LoginCorreo').val();
          var L_Password = $('#LoginPassword').val();
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: '../DesignAI/src/Controller/LoginForm.php', // Archivo PHP para procesar los datos en el servidor
            data: { Correo: L_Correo, Password: L_Password }, // Se envia el dato
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 2) {
                mensaje_Alerta('Llene todo los Campos');
              } else if (response == 0) {
                mensaje_Alerta('Correo/Contraseña Incorrecto');
              } else {
                window.location.href = '../DesignAI/src/View/inicio.php';
              }
            }
          });
        });

        //Enviar los Datos Introducidos en el formulario de Registro
        $('#BotonRegistro').click(function() {
          var formData = new FormData(document.querySelector('#Registro'));
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: '../DesignAI/src/Controller/RegistroForm.php', // Archivo PHP para procesar los datos en el servidor
            data: formData, // Se envia el dato
            processData: false,
            contentType: false,
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 4) {
                mensaje_Alerta('Error, Intente Nuevamente');
              } else if (response == 3) {
                mensaje_Alerta('Llene todo los Campos');
              } else if (response == 2) {
                mensaje_Alerta('Las contraseñas deben de Coincidir');
              } else if (response == 0) {
                mensaje_Alerta('El usuario ya esta registrado');
              } else {
                window.location.href = '../DesignAI/src/View/inicio.php';
              }
            }
          });
        });
      });
    </script>
  </body>
</html>
