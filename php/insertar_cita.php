<?php
    require "config.php";

    // Creo objeto y recojo las variables necesarias.
    $objeto_insertar_cita = new InsertarCita(DIRECCION,USUARIO,CONTRASEÑA,BD);
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $animal = $_POST["animal"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];

    // Lógica del PHP.
    if ($objeto_insertar_cita->insertar_cita($nombre,$apellidos,$email,$telefono,$animal,$fecha,$descripcion)){
        $array = ['status' => "OK"];
    }else{
        $array = ['status' => "ERROR"];
    }
    
    // Devuelvo el JSON con lo que corresponda.
    echo json_encode($array);

    // Defino la clase.
    class InsertarCita{

        // Variables de Clase.
        private $direccion;
        private $usuario;
        private $contraseña;
        private $bd;

        // Defino Constructor.
        public function __construct($direccion,$usuario,$contraseña,$bd){
            $this->direccion = $direccion;
            $this->usuario = $usuario;
            $this->contraseña = $contraseña;
            $this->bd= $bd;
        }

        // Función que inserta una nueva cita.
        public function insertar_cita($nombre,$apellidos,$email,$telefono,$animal,$fecha,$descripcion){
            $resultado = false;
            @ $conexion = new mysqli($this->direccion,$this->usuario,$this->contraseña,$this->bd);
            $consulta_insertar_cita = "INSERT INTO citas(nombre,apellido,email,telefono,animal,fecha,descripcion) VALUES ('$nombre','$apellidos','$email','$telefono','$animal','$fecha','$descripcion')";
            $conexion->query($consulta_insertar_cita);
            if ($conexion->affected_rows > 0){
                $resultado = true;
            }
            return $resultado;
        }

    }
    
?>