<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #e74c3c;
        --granate: #8b0a1a;
        --amber-indian: #FFC72C;
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

    .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 30px;
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
    }

    th {
        background-color: var(--primary-color);
        color: white;
        padding: 15px 10px;
        text-align: left;
        font-weight: bold;
        font-size: 16px;
        border-top-left-radius: var(--border-radius);
        border-top-right-radius: var(--border-radius);
    }

    td {
        padding: 15px 10px;
        text-align: left;
        font-size: 14px;
        border-bottom: 1px solid #ddd;
    }

    tr:nth-child(even) td {
        background-color: rgba(52, 152, 219, 0.1);
    }

    tr:hover td {
        background-color: rgba(52, 152, 219, 0.2);
    }

    .baja-btn {
        background-color: var(--granate);
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 8px 4px;
        cursor: pointer;
        border-radius: var(--border-radius);
        transition: all 0.3s ease;
    }

    .edit-btn {
        background-color: var(--amber-indian);
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 8px 4px;
        cursor: pointer;
        border-radius: var(--border-radius);
        transition: all 0.3s ease;
    }

    a:hover {
        opacity: 0.9;
    }
</style>



<h1>Ejemplo 6: Vista de perro</h1>

<table>

    <tr>

        <th>Marca</th>

        <th>Modelo</th>

        <th>Color</th>

        <th>Propietario</th>

        <th>Sexo</th>
    </tr>



    <tr>

    <td><?php echo $perro->getNombre() ?></td>

    <td><?php echo $perro->getRaza() ?></td>

    <td><?php echo $perro->getColor() ?></td>

    <td><?php echo $perro->getPeso() ?></td>

    <td><?php echo $perro->getSexo() ?></td>
    </tr>
</table>
    <a href="../baja/<?php echo urlencode($perro->getid()) ?>" class="baja-btn">Baja</a>
    <a href="../editar/<?php echo urlencode($perro->getId()) ?>" class="edit-btn">Editar</a>


