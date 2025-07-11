<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];

    $sql = "SELECT * FROM personas WHERE dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $persona = $resultado->fetch_assoc();
        echo "<h2>Datos del usuario</h2>";
        echo "DNI: " . $persona['dni'] . "<br>";
        echo "Nombres: " . $persona['nombres'] . "<br>";
        echo "Apellido Paterno: " . $persona['apellido_paterno'] . "<br>";
        echo "Apellido Materno: " . $persona['apellido_materno'] . "<br>";
    } else {
        echo "<script>alert('DNI no encontrado.'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit;
}
