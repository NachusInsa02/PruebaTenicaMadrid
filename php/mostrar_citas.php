<?php
    require "config.php";

    // Creo objeto y recojo las variables necesarias.
    $objeto_mostrar_citas = new MostrarCitas(DIRECCION,USUARIO,CONTRASEÑA,BD);

    // Lógica del PHP.
    $array_citas = $objeto_mostrar_citas->rescatar_citas();

    // Devuelvo el JSON con lo que corresponda.
    echo json_encode($array_citas);

    // Defino la clase.
    class MostrarCitas{

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

        // Función que rescata las citas.
        public function rescatar_citas(){
            @ $conexion = new mysqli($this->direccion,$this->usuario,$this->contraseña,$this->bd);
            $array_citas = [];
            $contador = 0;
            $consulta = "SELECT * FROM citas";
            $resultset = $conexion->query($consulta);
            while ($fila = $resultset->fetch_assoc()){
                $array_citas[$contador] = ["nombre" => $fila["nombre"],"apellido" => $fila["apellido"],"email" => $fila["email"],"telefono" => $fila["telefono"],"animal" => $fila["animal"],"fecha" => $fila["fecha"], "descripcion" => $fila["descripcion"]];
                $contador++;
            }
            return $array_citas;
        }

    }
    
?>