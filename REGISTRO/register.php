<?php 

header('Content-Type: application/json'); // Establece el tipo de contenido como JSON

// Recibir la solicitud (POST)
$data = json_decode(file_get_contents('php://input'), true);

if($_SERVER["REQUEST_METHOD"] === "POST"){


    echo json_encode("ok!");
}

?>