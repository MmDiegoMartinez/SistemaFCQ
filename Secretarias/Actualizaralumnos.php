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
    <title>Actualizar alumnos</title>
    <link rel="stylesheet" href="../css/csssecretaria.css">
</head>

<body>
<nav>
        <ul>
            <li><a href="IndexSecretarias.php"><img src="../iconos//homelogo.png" width="20px"><br>Home</a></li>
            <li><a href="SeleccionarCarreraXSemestre.php"><img src="../iconos//back.png" width="20px"><br>Atras</a></li>
        </ul>
        <h1 id="tituloLaboratorio"><img src="../iconos/logoFCQ.png" width="80">Actualizando estudiante...</h1>
    </nav>
    </div>
            <div class="loader">
            <div class="justify-content-center jimu-primary-loading"></div>
        </div>
    <div class = "contenedor2">
        
        <?php
        // Sanitizar los datos de entrada
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_STRING);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
        $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
        $grupo1 = filter_input(INPUT_POST, 'grupo1', FILTER_SANITIZE_STRING);
        $semestre1 = filter_input(INPUT_POST, 'semestre1', FILTER_SANITIZE_STRING);
        include('../funciones.php');
        $registros = actualizarAlumnos($matricula, $nombre, $apellido, $telefono, $correo, $grupo1, $semestre1);
        ?>
        
    </div>
    
</body>
</html>