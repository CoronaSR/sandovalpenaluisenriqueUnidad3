<?php
session_start();
if (empty($_SESSION['Cuenta_Activa'])){ //si no hay una sesion activa
  echo '<script>window.location.href = "http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/index.php";</script>';
}else {
  $Correo = $_SESSION['Cuenta_Activa'];
/* ============== CONSUMO DE WEB SERVICE ============== */
  // Consumir el servicio GET para obtener un usuario por correo
  $Consultar = file_get_contents("http://localhost/sandovalpenaluisenriqueUnidad3/API/web-service.php?correo=$Correo");
  $dataUser = json_decode($Consultar, true);
/* ==================================================== */
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

      .navbar{
        padding: 0px 20px;
        height: 80px;
        width: 100%;
        background: #000000;
        z-index: 1;
      }

      /* Letras del Logo "DESIGNAI" */
      .DESIGN{
        color: #ffffff;
      }.AI{
        color: #59d9de;
      }

      /* icono de close para el menu de perfil */
      .icono{
        background: #ffffff;
        font-size: 20px;
        padding: 10px;
        border-radius: 20px;
        cursor: pointer;
      }.icono-close{
        font-size: 35px;
        cursor: pointer;
        color: #205f6a;
      }

      /*contenedor principal*/
      .Principal{
        height: 100vh;
        display: grid;
        grid-template-columns: 60% 40%;
        background: linear-gradient(315deg, #AFF1F2 26%, #d4f9f8 74%);
        padding: 90px 10px 10px;
      }.Columna-1{ /* columna izquierda */
        padding: 10px;
      }.Columna-2{ /* columna derecha */
        padding: 10px;
        display: grid;
        grid-template-rows: 60% 40%;
      }.Columna-2 div{
        height: 100%;
      }

      .Perfil{ /* vista del perfil */
        display: none;
        width: 100%;
        height: 100vh;
        z-index: 2;
        background: #aff1f2;
        grid-template-rows: 60px auto;
        font-family: 'Encode Sans Condensed', sans-serif;
      }.fotoPerfil{ /*foto de perfil*/
        width: 150px;
        height: 150px;
        border: 2px solid #0f343d;
        border-radius: 75px;
      }.boton-perfil{ /*botones de acciones*/
        width: 100%;
        background: #1c7682;
        color: white;
        padding: 5px 30px;
        border: none;
        border-radius: 20px;
      }

      #dataperfil{ /*secciones de perfil, actualizar y eliminar*/
        display: flex;
      }#process_delete{
        display: none;
      }#process_update{
        display: none;
      }

      .fotoperfil{ /*foto de perfil en el formulario de actualizar*/
        cursor: pointer;
      }.fotoperfil img{
        width: 200px;
        height: 200px;
        border: 2px solid #1b939f;
        border-radius: 100px;
      }

      /* Contenedor de Vista de Error*/
      #Cont_Error{
        display: none;
        width: 100%;
        height: 100vh;
        z-index: 2;
        padding: 90px 10px 10px;
        background: rgba(0, 0, 0, .5);
      }.Alerta{ /*alerta*/
        height: 15rem;
        width: 30rem;
        border-radius: 10px;
        background: #bfe0e2;
        flex-direction: column;
        font-family: 'Encode Sans Condensed', sans-serif;
      }

      /* Diseño del Boton Principal "Entrar/Registrar" */
      .Boton_Principal{
        width: 60%;
        background: #1B939F;
        color: #ffffff;
        font-family: 'Encode Sans Condensed', sans-serif;
      }.Boton_Principal:hover{
        background: #205f6a;
        color: #ffffff;
      }

      /* Clase de inputs */
      .form-control{
        border: 2px solid #1b939f;
      }.form-control:focus{
        border: 2px solid #1DB5BD;
        box-shadow: none;
      }

      #response_chat{ /*contenedor de respuesta del chatgtp*/
        resize: none;
        font-family: 'Encode Sans Condensed', sans-serif;
        height: 65vh;
      }

      #editor{ /*input para ingresar css*/
        resize: none;
        font-family: 'Encode Sans Condensed', sans-serif;
        height: 80%;
        background: #000000;
        color: #ffffff;
        font-family: 'Encode Sans Condensed', sans-serif;
        padding: 15px 10px;
      }#objeto{ /*objeto a aplicar css*/
        padding: 5px 60px;
      }
    </style>
  </head>
  <body>

    <!--Navbar-->
    <div class="navbar fixed-top">
      <div>
        <h1><b class="DESIGN">DESIGN</b><b class="AI">AI</b></h1> <!--logo-->
      </div>
      <div>
        <ion-icon class="icono me-2" name="person" onclick="Open()"></ion-icon> <!--Boton de perfil-->
      </div>
    </div>

    <!--Mi Perfil-->
    <div class="Perfil fixed-top" id="Perfil">
      <div class="d-flex align-items-center justify-content-end pe-4">
        <ion-icon class="icono-close" name="close" onclick="Close()" id="icono_close"></ion-icon>
      </div>
      <div class="flex-column align-items-center justify-content-center" id="dataperfil">
        <h1>Mi Perfil</h1>
        <!--datos del perfil-->
        <?php
          echo '<img class="fotoPerfil mb-2" src="http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/src/Controller/'.$dataUser[0]['imagen'].'">';
          echo '<b class="mb-3">'.$dataUser[0]['nombre'].'</b>';
          echo '<form method="post" action="">';
          echo '<button type="button" class="mb-2 boton-perfil" onclick="next(\'process_update\')"><b>Cambiar Foto</b></button><br>';
          echo '<button type="button" class="mb-2 boton-perfil" onclick="next(\'process_delete\')"><b>Eliminar Cuenta</b></button><br>';
          echo '<button type="submit" class="boton-perfil" name="logout"><b>Cerrar Sesion</b></button>';
          echo '</form>';
        ?>
      </div>
      <!--Contenedor para confirmar proceso de DELETE-->
      <div class="flex-column align-items-center justify-content-center" id="process_delete">
        <h2>¿Seguro que desea eliminar esta cuenta?</h2>
        <p>No hay vuelta atras</p>
        <form method="post" action="">
          <button type="submit" class="btn btn-success" name="delete_count">Si</button>
          <button type="button" class="btn btn-danger" onclick="cancel('process_delete')">No</button> <!--cancelar/cerrar proceso de delete-->
        </form>
      </div>
      <!--contenedor para proceso de actualizar-->
      <form method="post" action="" enctype="multipart/form-data" class="flex-column align-items-center justify-content-center" id="process_update">
        <label for="UpdateFoto" class="mb-3 fotoperfil">
          <img src="<?php echo 'http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/src/Controller/'.$dataUser[0]['imagen']; ?>" id="PrevisualizacionFoto" src="#" alt="Vista previa">
        </label>
        <input type="file" id="UpdateFoto" name="UpdateFoto" accept=".jpg, .jpeg, .png" style="display: none;">
        <div>
          <button type="button" class="btn btn-success" id="BotonUpdate">Guardar</button>
          <button type="button" class="btn btn-danger" onclick="cancel('process_update')">Cancelar</button> <!--cancelar/cerrar proceso de update-->
        </div>
      </form>
    </div>

    <!--Interfaz Error-->
    <div class="align-items-center justify-content-center fixed-top" id="Cont_Error">
      <div class="Alerta d-flex align-items-center justify-content-center shadow">
        <b class="mb-3" id="textAlert">Alerta</b>
        <button class="btn Boton_Principal" id="acept" onclick="closeAlert()"><b>Aceptar</b></button>
      </div>
    </div>

    <!--Contenedor Principal-->
    <div class="Principal">
        <div class="Columna-1 d-flex align-items-center justify-content-center flex-column">
          <div class="container-fluid mb-4" align="center">
            <input class="form-control mb-2" type="text" id="mensaje_chat"> <!--input de mensaje al chat-->
            <button class="btn Boton_Principal" type="button" id="enviar_mensaje">Enviar</button> <!--boton para enviar mensaje al chat-->
          </div>
          <div class="container-fluid">
            <textarea id="response_chat" class="form-control" disabled></textarea> <!--contenedor de respuesta del chat-->
          </div>
        </div>
        <div class="Columna-2 d-flex align-items-center justify-content-center flex-column">
          <div class="container-fluid" align="center">
            <textarea id="editor" class="form-control mb-2"></textarea> <!--input que recibe atributos css-->
            <button class="btn Boton_Principal" onclick="aplicarAtributos()"><b>Aplicar Cambios</b></button> <!--boton para aplicar atributos-->
          </div>
          <div class="container-fluid d-flex align-items-center justify-content-center">
            <button id="objeto">Boton</button> <!--objeto que recibe atributos css-->
          </div>
        </div>
    </div>

    <!--Scripts de Boostrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--Libreria de Iconos-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!--Script para formularios-->
    <script>
    let view = document.getElementById("Perfil");

      //Cerrar Perfil
      function Close(){
        view.style.display = 'none';
      }
      //Abrir Perfil
      function Open(){
        view.style.display = 'grid';
      }


      function next(process) { //cambiar a session para actualizar o confirmar eliminacion
        next_process = document.getElementById(process); //seccion a mostrar
        interfaz_actual = document.getElementById('dataperfil'); //seccion a ocultar
        iconoclose = document.getElementById('icono_close'); //icono de close

        next_process.style.display = 'flex';
        interfaz_actual.style.display = 'none';
        icono_close.style.display = 'none';
      }

      function cancel(process) { //boton para cancelar proceso
        next_process = document.getElementById(process); //seccion a ocultar
        interfaz_actual = document.getElementById('dataperfil'); //seccion a mostrar
        iconoclose = document.getElementById('icono_close'); //icono de close

        next_process.style.display = 'none';
        interfaz_actual.style.display = 'flex';
        icono_close.style.display = 'flex';
      }


      /*Alertas*/
      let cont_Error = document.getElementById('Cont_Error');

      function mensaje_Alerta(mensaje){ //mostrar alerta
        cont_Error.style.display = 'flex';
        $('#textAlert').html(mensaje); 
      }
      /*Cerrar Alerta*/
      function closeAlert(){
        cont_Error.style.display = 'none';
      }

      $(document).ready(function() {
        //Enviar los Datos Introducidos en el formulario de chatbot
        $('#enviar_mensaje').click(function() {
          var peticion = $('#mensaje_chat').val();
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: '../Controller/chatgtp.php', // Archivo PHP para procesar los datos en el servidor
            data: { Peticion: peticion }, // Se envia el dato
            success: function(response) {
              if (response == 1){ //si no se ingresa un mensaje
                mensaje_Alerta('Ingrese un Mensaje');
              } else {
                const respuesta = JSON.parse(response); //formato de JSON
                console.log(respuesta);
                // Accede al contenido (content)
                const contenido = respuesta.choices[0].message.content;
                //imprimimos el resultado en el apartado correspondiente
                $('#response_chat').html(contenido); 
              }
            }
          });
        });

        //Enviar el dato de la nueva foto de perfil
        $('#BotonUpdate').click(function() {
          var dataupdate = new FormData(document.querySelector('#process_update'));
          // Realizar la petición AJAX
          $.ajax({
            type: 'POST',
            url: '../Controller/UpdateForm.php', // Archivo PHP para procesar los datos en el servidor
            data: dataupdate, // Se envia el dato
            processData: false,
            contentType: false,
            success: function(response) {
              // Manejar la respuesta del servidor aquí
              if (response == 0) {
                mensaje_Alerta('Error, Intente Nuevamente');
              } else {
                mensaje_Alerta('Perfil Actualizado');
              }
            }
          });
        });

      });



      function aplicarAtributos() {
        // Obtencion de los atributos CSS desde el textarea (editor)
        var atributosCSS = document.getElementById('editor').value;

        // Objeto al que aplicamos el css
        var outputButton = document.getElementById('objeto');

        // Se aplican los atributos css al objeto
        try {
          outputButton.style.cssText = atributosCSS;
        } catch (error) {
          // En caso de error, alerta
          mensaje_Alerta('Error al aplicar atributos CSS.');
        }
      }


      // Obtener referencias a los elementos del formulario
      const inputFotoPerfil = document.getElementById('UpdateFoto');
      const fotoPerfil = document.getElementById('PrevisualizacionFoto');
      
      inputFotoPerfil.addEventListener('change', function () { //al detectar un cambio en el input
      const archivo = inputFotoPerfil.files[0]; //obtiene informacion del file
        if (archivo) {
          const reader = new FileReader();
          
          reader.onload = function () { //funcion de mostrar nuevo file
            fotoPerfil.src = reader.result;
          };
          
          reader.readAsDataURL(archivo); //muestra el file seleccionado
        }

      });
    </script>

  </body>
</html>

<?php
if (isset($_POST['logout'])){
  session_destroy(); //desturimos la sesion
  //nos redirige al index
  echo '<script>window.location.href = "http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/index.php";</script>';
}

if (isset($_POST['delete_count'])){
  // Datos del usuario a eliminar
  $idUsuarioEliminar = $dataUser[0]['id'];
  // Configuración de la solicitud cURL
  $curl = curl_init();
  // Configura la URL del servicio web
  $url = 'http://localhost/API/web-service.php?id=' . $idUsuarioEliminar;
  // Configura otras opciones cURL según sea necesario
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  // Realiza la solicitud cURL y obtiene la respuesta
  $response = curl_exec($curl);
  
  // Verifica si la solicitud fue exitosa
  if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200) {
    session_destroy(); //desturimos la sesion
    //nos redirige al index
    echo '<script>
      window.location.href = "http://localhost/sandovalpenaluisenriqueUnidad3/DesignAI/index.php";
    </script>';
  } else { //si no alerta
    echo '<script>
      mensaje_Alerta("Error al Eliminar la Cuenta");
    </script>';
  }
  
  // Cierra la sesión cURL
  curl_close($curl);
}

?>
