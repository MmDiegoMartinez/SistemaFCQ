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
    <title>Actualizar Calificaciones</title>
    <link rel="stylesheet" href="../css/csssecretaria.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="IndexSecretarias.php"><img src="../iconos//homelogo.png" width="20px"><br>Home</a></li>
        </ul>
        <h1 id="tituloLaboratorio"><img src="../iconos/logoFCQ.png" width="80">Editando Calificación...</h1>
    </nav>
    </div>
            <div class="loader">
            <div class="justify-content-center jimu-primary-loading"></div>
        </div>
    <div class = "contenedor2">
        <?php
        $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_STRING);
        $claveMateria = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_STRING);
        $calificacion = filter_input(INPUT_POST, 'calificacion', FILTER_SANITIZE_STRING);
        include('../funciones.php');
        
        ActualizarCalificaciones($calificacion,$claveMateria,$matricula);
        ?>
    </div>
    
</body>
</html>