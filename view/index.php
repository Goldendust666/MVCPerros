
<?php


// Resto del código...
/*
require_once 'controller/LoginController.php';

$loginController = new LoginController();

if (isset($_SESSION['usuario'])) {
    echo "Bienvenido, " . $_SESSION['nombre'];
} else {
    $loginController->mostrarVistaLogin();
}*/
?>/<style>

        :root {
            --primary-color: #3498db;
            --secondary-color: #e74c3c;
            --background-color: #f4f4f4;
            --text-color: #333;
            --border-radius: 10px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-color);
        }
        img {
        max-width: 7%;
        height: auto;
        object-fit: contain;
        display: block;
    }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-top: 20px;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 18px;
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
        }

        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) th,
        tr:nth-child(even) td {
            background-color: rgba(52, 152, 219, 0.1);
        }

        tr:hover td {
            background-color: rgba(229, 76, 60, 0.1);
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }
        .ver-btn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: var(--border-radius) var(--border-radius) var(--border-radius) var(--border-radius);
       
    }
    .crear-btn {
        background-color: #800080;
        border: none;
        color: white;
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: var(--border-radius) var(--border-radius) var(--border-radius) var(--border-radius);
       
    }

    /* Estilo para el botón hover */
    .ver-btn:hover {
        background-color: #45a049;
    }
</style>



<h1>Ejemplo 5: Listado de perros</h1>

<table>

    <tr>

        <th>Nombre</th>

        <th>Raza</th>

        <th>Color</th>

        <th>Peso</th>

        <th>Sexo</th>
        
        <th>Ver</th>
    </tr>

    <?php foreach ($rowset as $id => $row): ?>



        <tr>

            <td><?php echo $row->getnombre() ?></td>

            <td><?php echo $row->getraza() ?></td>

            <td><?php echo $row->getcolor() ?></td>

            <td><?php echo $row->getPeso() ?></td>

            <td ><?php echo $row->getSexo() ?></td>

            <td><a href="index.php/ver/<?php echo urlencode($row->getid()) ?>" class="ver-btn">Ver</a></td>        </tr>



     <?php endforeach; ?>
     <a href="index.php/alta/" class="crear-btn">Insertar nuevo</a>
</table>


