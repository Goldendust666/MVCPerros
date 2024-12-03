<?php
class Perro
{
    private $id;
    private $nombre;
    private $raza;
    private $color;
    private $peso;
    private $sexo;
    public function __construct( $id,$nombre, $raza, $color, $peso,$sexo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->color = $color;
        $this->peso = $peso;
        $this->sexo =$sexo;
    }

    // Métodos getter y setter
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getRaza() { return $this->raza; }
    public function getColor() { return $this->color; }
    public function getPeso() { return $this->peso; }
    public function getSexo() { return $this->sexo; }

    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setRaza($raza) { $this->modelo = $raza; }
    public function setColor($color) { $this->color = $color; }
    public function setPeso($peso) { $this->peso = $peso; }
    public function setSexo($sexo) { $this->sexo = $sexo; }
public static function obtenerPerros()
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=animales', 'root', '');
        
        $rows = $db->query('SELECT id, nombre, raza, color, peso, sexo from perros');
        
        $perros = [];
        
        while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
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
public static function eliminarPerro($id)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=animales', 'root', '');
        
        $stmt = $db->prepare("DELETE FROM perros WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $db = null;
    } catch (PDOException $e) {
        echo "Error al eliminar el coche de la base de datos: " . $e->getMessage();
    }
}

public static function guardarPerros($perros)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=animales', 'root', '');
        
        // Eliminar todos los registros existentes
        $stmt = $db->prepare("DELETE FROM perros");
        $stmt->execute();
        
        // Insertar nuevos registros
        foreach ($perros as $perro) {
            $stmt = $db->prepare("INSERT INTO perros (id, nombre, raza , color, peso, sexo) VALUES (:id, :nombre, :raza, :color, :peso, :sexo)");
            $stmt->bindParam(':id', $perro->getId());
            $stmt->bindParam(':nombre', $perro->getNombre());
            $stmt->bindParam(':raza', $perro->getRaza());
            $stmt->bindParam(':color', $perro->getColor());
            $stmt->bindParam(':peso', $perro->getPeso());
            $stmt->bindParam(':sexo', $perro->getSexo());
            $stmt->execute();
        }
        
        $db = null;
        echo "Los perros se han guardado correctamente en la base de datos.";
    } catch (PDOException $e) {
        echo "Error al guardar los perros en la base de datos: " . $e->getMessage();
    }
}
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

public static function actualizarPerro($id,$nombre, $raza, $color, $peso,$sexo)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=animales', 'root', '');
        
        $stmt = $db->prepare("UPDATE perro SET nombre = :nombre, raza = :raza, color = :color, peso = :peso WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':raza', $raza);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':peso', $peso);
        $stmt->execute();

        $db = null;
        return true;
    } catch (PDOException $e) {
        echo "Error al actualizar el perro: " . $e->getMessage();
        return false;
    }
}

}