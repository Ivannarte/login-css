<?php
session_start();

// El "Cadenero": Si no hay sesión activa, lo mandamos al login
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Panel</title>
</head>
<body>
    <h1>Hola, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <p>Has entrado correctamente a la zona privada.</p>
    
    <hr>
    <a href="logout.php">Cerrar sesión segura</a>
</body>
</html>