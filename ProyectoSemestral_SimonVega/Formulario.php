<?php
// Datos de conexión
$servername = "localhost"; 
$username = "root";  
$password = ""; 
$dbname = "semestral"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$email = $_POST['email'];
$comentario = $_POST['comentario'];

// Validación del campo email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Preparar y ejecutar la consulta SQL para insertar los datos
    $stmt = $conn->prepare("INSERT INTO cometarios (email, comentario, fecha) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $comentario);

    if ($stmt->execute()) {
        // Redirigir a la página principal después de enviar el comentario
        header("Location: Principal.php"); // Cambia 'index.php' por la URL de tu página principal
        exit(); // Asegura que se detenga el script después de la redirección
    } else {
        echo "Error al enviar el comentario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, introduce un email válido con '@'.";
}

// Cerrar conexión
$conn->close();
?>


