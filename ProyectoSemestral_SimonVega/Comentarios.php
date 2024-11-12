<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "semestral";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los comentarios de la base de datos
$sql = "SELECT email, comentario, fecha FROM cometarios ORDER BY fecha DESC";
$resultado = $conn->query($sql);

// Contenedor de la sección de comentarios
echo "<div class='comentarios-section'>";
echo "<h2>Comentarios</h2>";

if ($resultado->num_rows > 0) {
    // Iterar sobre cada comentario
    while ($fila = $resultado->fetch_assoc()) {
        echo "<div class='comentario nuevo-comentario'>"; // Clase para cada comentario
        echo "<p><strong>Email:</strong> " . htmlspecialchars($fila["email"]) . "</p>";
        echo "<p><strong>Fecha:</strong> " . $fila["fecha"] . "</p>";
        echo "<p><strong>Comentario:</strong><br>" . htmlspecialchars($fila["comentario"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No hay comentarios aún.</p>";
}

echo "</div>"; // Cerrar el contenedor de la sección de comentarios
$conn->close();
?>
<link rel="stylesheet" href="Comentarios.css">
