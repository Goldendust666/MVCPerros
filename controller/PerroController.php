<?php

// Este archivo contiene el controlador principal para gestionar las operaciones de coches
include_once './model/Perro.php';
class PerroController
{
    private $perros;

    // Constructor que inicializa los coches desde el modelo
    public function __construct()
    {
        $this->perros = Perro::obtenerPerros();
    }

    // Método para mostrar todos los coches
    public function index()
    {
        $rowset = $this->perros;
        require("view/index.php");
    }

    // Método para ver detalles de un coche por ID
    public function ver($id)
    {
        $perro = null;
        
        foreach ($this->perros as $guau) {
            if ($guau->getId() == $id) {
                $perro = $guau;
                break;
            }
        }
        
        if ($perro !== null) {
            require("view/ver.php");
        } else {
            $this->index();
        }
    }
    public function alta()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $raza = $_POST['raza'];
            $color = $_POST['color'];
            $peso = $_POST['peso'];
            $sexo = $_POST['sexo'];
            
            // Crear un nuevo Perro y agregarlo al array
            $perro = new Perro(null, $nombre, $raza, $color, $peso, $sexo);
            $this->perros[] = $perro;
        
            // Guardar los perros en la base de datos
            Perro::guardarPerros($this->perros);
    
            header("Location: ../../index.php");
            exit;
        } else {
            require("view/alta.php");
        }
    }
    
    public function baja($id)
    {
        $perro = null;
        foreach ($this->perros as $guau) {
            if ($guau->getId() == $id) {
                $perro = $guau;
                break;
            }
        }
                
        if ($perro !== null) {
            // Eliminar el perro del array local
            unset($this->perros[array_search($perro, $this->perros)]);
            
            // Llama al método para eliminar el perro de la base de datos
            Perro::eliminarPerro($id);
            
            // Muestra un mensaje de éxito
            echo "El perro ha sido eliminado con éxito.";
        } else {
            echo "No se encontró un perro con el ID proporcionado.";
        }
                
        header("Location: ../../index.php");
        exit;
    }
    
    public function editar($id)
    {
        $perro = null;
        
        foreach ($this->perros as $guau) {
            if ($guau->getId() == $id) {
                $perro = $guau;
                break;
            }
        }
    
        if ($perro !== null) {
            // Preparo los datos para pasar al formulario de edición
            $_GET['perro'] = [
                'id' => $perro->getId(),
                'nombre' => $perro->getNombre(),
                'raza' => $perro->getRaza(),
                'color' => $perro->getColor(),
                'peso' => $perro->getPeso(),
                'sexo' => $perro->getSexo()
            ];
            
            require("view/editar.php");
        } else {
            $this->index();
        }
    }
    public function actualizar($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $raza = $_POST['raza'];
            $color = $_POST['color'];
            $peso = $_POST['peso'];
            $sexo = $_POST['sexo'];
    
            // Busca el perro existente y lo actualiza
            foreach ($this->perros as &$guau) {
                if ($guau->getId() == $id) {
                    $guau->setNombre($nombre);
                    $guau->setRaza($raza);
                    $guau->setColor($color);
                    $guau->setPeso($peso);
                    $guau->setSexo($sexo);
                   
                    break;
                }
            }
    
            // Guarda los perros en la base de datos
            Perro::guardarPerros($this->perros);
    
            header("Location: ../../index.php");
            exit;
        } else {
            require("view/editar.php");
        }
    }
    

}


