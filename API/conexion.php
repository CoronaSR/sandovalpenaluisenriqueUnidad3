<?php
    // Definición de la clase Conexion que extiende la clase PDO
	class Conexion extends PDO
	{
		// Propiedades privadas que contienen la información de conexión a la base de datos
		private $hostBd = 'localhost';
		private $nombreBd = 'designai';
		private $usuarioBd = 'root';
		private $passwordBd = '';
		
		// Constructor de la clase que intenta establecer la conexión a la base de datos
		public function __construct()
		{
			try {
				// Llamada al constructor de la clase padre (PDO) para establecer la conexión
				// Uso de la información proporcionada en las propiedades privadas
				parent::__construct('mysql:host=' . $this->hostBd . ';dbname=' . $this->nombreBd . ';charset=utf8', $this->usuarioBd, $this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				
			} catch(PDOException $e) {
				// En caso de error, imprime el mensaje de error y finaliza el script
				echo 'Error: ' . $e->getMessage();
				exit;
			}
		}
	}
?>
