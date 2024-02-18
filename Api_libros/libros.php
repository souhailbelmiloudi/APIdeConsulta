<?php
include_once __DIR__ . '/clases/Validacion.php';
include_once __DIR__ . '/clases/Response.php';

// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");

// Obtener parámetros de la URL
$rutaArchivoXml = __DIR__ . '/xml/books.xml';
$validacion = new Validacion($rutaArchivoXml);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $parametrosUrl = $_GET;
    $respuesta = $validacion->obtenerLibrosConValidacion($parametrosUrl);
    echo $respuesta;
} else {
    $respuestaError = ['error' => 'Método no permitido'];
    echo Response::result(405, $respuestaError);
}
?>
