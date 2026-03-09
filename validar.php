<?php
// 1. Iniciar la sesión antes que cualquier otra cosa
session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mi_sistema";

$conexion = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. Recibir datos (validando que existan)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password_ingresada = $_POST['password'];

    // 3. Consulta preparada (Seguridad contra Inyección SQL)
    $query = "SELECT id, username, password_hash FROM usuarios WHERE username = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($user = $resultado->fetch_assoc()) {
        // 4. Verificar el hash de la contraseña
        if (password_verify($password_ingresada, $user['password_hash'])) {
            
            // ÉXITO: Guardamos datos en la sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['autenticado'] = true;

            // Redirigir al panel de control
            header("Location: dashboard.php");
            exit();

        } else {
            echo "La contraseña es incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }
    
    $stmt->close();
}

$conexion->close();
?>