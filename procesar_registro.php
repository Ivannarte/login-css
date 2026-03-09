<?php
// Configuración de conexión (Igual que en validar.php)
$host = "localhost";
$db_user = "root"; 
$db_pass = ""; 
$db_name = "mi_sistema";

$conexion = new mysqli($host, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['nuevo_usuario'];
    $pass = $_POST['nueva_password'];

    // 1. ENCRIPTAR LA CONTRASEÑA
    // Jamás guardes la clave real. password_hash crea una cadena irreconocible.
    $pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);

    // 2. INSERTAR EN LA BASE DE DATOS
    $sql = "INSERT INTO usuarios (username, password_hash) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $user, $pass_encriptada);

    if ($stmt->execute()) {
        echo "<h3>¡Usuario creado con éxito!</h3>";
        echo "<a href='index.html'>Ir al Login para probar</a>";
    } else {
        if ($conexion->errno == 1062) { // Error de duplicado
            echo "Lo siento, ese nombre de usuario ya existe.";
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
    }
    
    $stmt->close();
}
$conexion->close();
?>