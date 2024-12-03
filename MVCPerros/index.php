<?php
// Incluyo los archivos necesarios
require "./model/Perro.php";
require "./controller/PerroController.php";

// Instancio el controlador
$controller = new PerroController();

// Ruta de la home
$home = "/MVCPerros/index.php/";

// Quito la home de la ruta de la barra de direcciones
$ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);

// Creo el array de ruta (filtrando los vacíos)
$array_ruta = array_filter(explode("/", $ruta));

// Decido la ruta en función de los elementos del array
if (isset($array_ruta[0]) && $array_ruta[0] == "ver" && is_numeric($array_ruta[1])) {
    // Llamo al método ver pasándole la clave que me están pidiendo
    $controller->ver($array_ruta[1]);
} elseif (isset($array_ruta[0]) && $array_ruta[0] == "alta") {
    // Llamo al método alta del controlador
    $controller->alta();
} elseif (isset($array_ruta[0]) && $array_ruta[0] == "baja") {
    // Llamo al método baja del controlador
    $controller->baja($array_ruta[1]);
} elseif (isset($array_ruta[0]) && $array_ruta[0] == "editar" && is_numeric($array_ruta[1])) {
    // Llamo al método editar del controlador
    $controller->editar($array_ruta[1]);
} else {
    // Llamo al método por defecto del controlador
    $controller->index();
}
