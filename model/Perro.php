<?php
class Perro
{
    // Atributos privados de la clase Perro
    private $id;
    private $nombre;
    private $raza;
    private $color;
    private $peso;
    private $sexo;

    // Constructor de la clase Perro
    public function __construct($id, $nombre, $raza, $color, $peso, $sexo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->color = $color;
        $this->peso = $peso;
        $this->sexo = $sexo;
    }

    // Métodos getter y setter para acceder y modificar los atributos privados
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

        // ... otros métodos ...
    
        public static function crearBaseDeDatos()
        {
            try {
                $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($dsn, 'root', '', $options);
                
                // Crear la base de datos si no existe
                $pdo->exec("CREATE DATABASE IF NOT EXISTS animales");
    
                // Conectar a la base de datos recién creada
                $pdo = new PDO($dsn, 'root', '', $options);
    
                // Crear la tabla perros si no existe
                $pdo->exec("
                    CREATE TABLE IF NOT EXISTS perros (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(100),
                        raza VARCHAR(50),
                        color VARCHAR(50),
                        peso FLOAT,
                        sexo VARCHAR(1)
                    )
                ");
    
                // Crear la tabla usuarios si no existe
                $pdo->exec("
                    CREATE TABLE IF NOT EXISTS usuarios (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nombre VARCHAR(100),
                        contraseña VARCHAR(255)
                    )
                ");
    

            } catch (PDOException $e) {
                echo "Error al crear la base de datos o las tablas: " . $e->getMessage();
            }
        }   
    
    // Método estático para obtener todos los perros de la base de datos
    public static function obtenerPerros()
    {    
        try {

            $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, 'root', '', $options);
            
            $stmt = $pdo->prepare("SELECT id, nombre, raza, color, peso, sexo from perros");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            
            $perros = [];
            
            foreach ($rows as $row) {
                $perro = new Perro(
                    $row['id'],
                    $row['nombre'],
                    $row['raza'],
                    $row['color'],
                    $row['peso'],
                    $row['sexo']
                );
                $perros[] = $perro;
            }
            
            return $perros;
        } catch (PDOException $e) {
            echo "Error al conectar con la base de datos: " . $e->getMessage();
            return [];
        }
    }

    // Método estático para eliminar un perro de la base de datos
    public static function eliminarPerro($id)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, 'root', '', $options);
            
            $stmt = $pdo->prepare("DELETE FROM perros WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar el perro de la base de datos: " . $e->getMessage();
            return false;
        }
    }

    // Método estático para guardar una lista de perros en la base de datos
    public static function guardarPerros($perros)
    {
        try {
            $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, 'root', '', $options);
            
            // Eliminar todos los registros existentes
            $stmt = $pdo->prepare("DELETE FROM perros");
            $stmt->execute();
            
            // Insertar nuevos registros
            foreach ($perros as $perro) {
                $stmt = $pdo->prepare("INSERT INTO perros (id, nombre, raza, color, peso, sexo) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$perro->getId(), $perro->getNombre(), $perro->getRaza(), $perro->getColor(), $perro->getPeso(), $perro->getSexo()]);
            }
            
            return true;
        } catch (PDOException $e) {
            echo "Error al guardar los perros en la base de datos: ". $e->getMessage();
            return false;
        }
    }

    // Método estático para crear una nueva instancia de Perro
    public static function crearPerro($id = null, $nombre, $raza, $color, $peso, $sexo)
    {
        if ($id === null) {
            // Si no se especifica id, usará el siguiente valor auto-incremental
            return new Perro(null, $nombre, $raza, $color, $peso, $sexo);
        } else {
            // Si se especifica un id, lo usará
            return new Perro($id, $nombre, $raza, $color, $peso, $sexo);
        }
    }
        // Método estático para actualizar los datos de un perro en la base de datos
        public static function actualizarPerro($id, $nombre, $raza, $color, $peso, $sexo)
        {
            try {
                $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($dsn, 'root', '', $options);
                
                $stmt = $pdo->prepare("UPDATE perros SET nombre = :nombre, raza = :raza, color = :color, peso = :peso WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':raza', $raza);
                $stmt->bindParam(':color', $color);
                $stmt->bindParam(':peso', $peso);
                $stmt->execute();
    
                return true;
            } catch (PDOException $e) {
                echo "Error al actualizar el perro: " . $e->getMessage();
                return false;
            }
        }
    
        // Método estático para obtener un perro específico por ID
        public static function getPerroById($id)
        {
            try {
                $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($dsn, 'root', '', $options);
                
                $stmt = $pdo->prepare("SELECT * FROM perros WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                return $stmt->fetchObject('Perro');
            } catch (PDOException $e) {
                echo "Error al obtener el perro: " . $e->getMessage();
                return null;
            }
        }
    
        // Método estático para verificar si existe un perro con un nombre específico
        public static function existePerroPorNombre($nombre)
        {
            try {
                $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($dsn, 'root', '', $options);
                
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM perros WHERE nombre = :nombre");
                $stmt->bindParam(':nombre', $nombre);
                $stmt->execute();
                
                return (bool)$stmt->fetchColumn();
            } catch (PDOException $e) {
                echo "Error al verificar si existe el perro: " . $e->getMessage();
                return false;
            }
        }
    
        // Método estático para obtener el número de perros en la base de datos
        public static function contarPerros()
        {
            try {
                $dsn = "mysql:host=localhost;dbname=animales;charset=utf8mb4";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO($dsn, 'root', '', $options);
                
                $stmt = $pdo->query("SELECT COUNT(*) FROM perros");
                return $stmt->fetchColumn();
            } catch (PDOException $e) {
                echo "Error al contar los perros: " . $e->getMessage();
                return 0;
            }
        }
    }
    
