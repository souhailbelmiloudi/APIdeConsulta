<?php

/**
 * Clase Response: se encarga de crear la respuesta json a la petición del endpoint
 */
class Response
{
    /**
     * Método result: transforma el array de la respuesta en un json que se
     * devuelve al cliente como resultado de su petición
     * @param int $code El código de la respuesta
     * @param array $response El array de datos que vamos a convertir a json
     * @return void
     */
    public static function result($code, $response)
    {
        // Establecer el código de respuesta HTTP
        http_response_code($code);

        // Establecer las cabeceras para indicar que la respuesta es JSON
        header('Content-Type: application/json');

        // Convertir el array a formato JSON
        $jsonResponse = json_encode($response, JSON_PRETTY_PRINT);

        // Imprimir la respuesta JSON
        echo $jsonResponse;
    }
}


?>