<?php
    //llamada al archivo con la conexion a la BD
	include 'conexion.php';
	
	$pdo = new Conexion();
	
	//Peticion de consultar registros
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		if(isset($_GET['correo']))
		{
			//consultar un registro en especifico
			$sql = $pdo->prepare("SELECT * FROM usuarios WHERE correo=:correo");
			$sql->bindValue(':correo', $_GET['correo']);
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll());
			exit;				
			
			} else {
			//consultar todos los resgistros
			$sql = $pdo->prepare("SELECT * FROM usuarios");
			$sql->execute();
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			//respuesta
			header("HTTP/1.1 200 hay datos");
			echo json_encode($sql->fetchAll()); //datos en formato JSON
			exit;		
		}
	}
	
	//Peticion para insertar un registro
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO usuarios (nombre, imagen, correo, password) VALUES(:nombre, :imagen, :correo, :password)";
		$stmt = $pdo->prepare($sql);
		//Valores de los Parametros
		$stmt->bindValue(':nombre', $_POST['nombre']);
		$stmt->bindValue(':imagen', $_POST['imagen']);
		$stmt->bindValue(':correo', $_POST['correo']);
		$stmt->bindValue(':password', $_POST['password']);
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			//respuesta
			header("HTTP/1.1 200 Ok");
			echo json_encode((int)$idPost); //datos en formato JSON
			exit;
		}
	}
	
	//Peticion para actualizar registro
	if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		parse_str(file_get_contents("php://input"), $_PUT);
		var_dump($_PUT);

		$sql = "UPDATE usuarios SET imagen=:imagen WHERE correo=:correo";
		$stmt = $pdo->prepare($sql);
		//Valores de los Parametros
		$stmt->bindValue(':imagen', $_PUT['imagen']);
		$stmt->bindValue(':correo', $_PUT['correo']);
		$stmt->execute();
		//respuesta
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Peticion para eliminar registro
	if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$sql = "DELETE FROM usuarios WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		//Valores del parametro
		$stmt->bindValue(':id', $_GET['id']);
		$stmt->execute();
		//respuesta
		header("HTTP/1.1 200 Ok");
		exit;
	}
	
	//Si la peticion no cerresponde a ninguna de las anteriores
	header("HTTP/1.1 400 Bad Request");
?>