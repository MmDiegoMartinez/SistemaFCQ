<?php
session_start();
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: LoginSecretarias.php");
    exit();
}

$inactive_time = 1800;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_time)) {
    // Si ha pasado demasiado tiempo, cerrar sesión
    session_unset();
    session_destroy();
    header("Location: LoginSecretarias.php");
    exit();
}

// Actualizar la marca de tiempo de la última actividad
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Laboratorios</title>
    <link rel="stylesheet" href="../css/csssecretaria.css">
</head>

<body>
<nav>
        <ul>
            <li><a href="IndexSecretarias.php"><img src="../iconos//homelogo.png" width="20px"><br>Home</a></li>
        </ul>
        <h1 id="tituloLaboratorio"><img src="../iconos/logoFCQ.png" width="80">Actualizando Laboratorio...</h1>
    </nav>
    <div class = "contenedor2">
    <div class="loader">
            <div class="justify-content-center jimu-primary-loading"></div>
        </div>
    <?php
    // Sanitizar los datos de entrada
    
    $idlaboratorio = filter_input(INPUT_POST, 'idlab', FILTER_SANITIZE_STRING);
    $nombreLaboratorio = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $encargado = filter_input(INPUT_POST, 'jefe', FILTER_SANITIZE_STRING);
    include('../funciones.php');
    actualizarLaboratorios($idlaboratorio, $nombreLaboratorio, $encargado);
    //$registros = actualizarAlumnos($matricula, $nombre, $apellido, $telefono, $correo, $grupo1, $semestre1);
   

    ?>

    </div>
    
</body>
</html>