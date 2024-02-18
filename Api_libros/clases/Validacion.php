<?php
include_once 'LeerXml.php';
include_once 'Response.php';

class Validacion extends LeerXml {

    // Lista de parámetros permitidos
    private $parametrosPermitidos = ['id', 'autor', 'genero', 'pagina','publicacion'];

    // Función para validar los parámetros y realizar la consulta
    public function obtenerLibrosConValidacion($params) {
        // Validar los parámetros
        $paramsValidos = $this->validarParametros($params);
        

        if (!$paramsValidos) {
            // Si los parámetros no son válidos, devolver una respuesta de error
            $respuestaError = ['error' => 'Parmetros no validos'];
            return Response::result(400, $respuestaError);
        }else{
              // Si los parámetros son válidos, realizar la consulta
            $respuesta = $this->obtenerLibros($paramsValidos);
            if (empty($respuesta)) {
                // Si no se encontraron resultados, devolver una respuesta de error
                $respuestaError = ['error' => 'No se encontraron resultados'];
                return Response::result(404, $respuestaError);
            }
            return Response::result(200,$respuesta);
            
        }

      
    }

    // Función para validar los parámetros
   private function validarParametros($params) {
    // Verificar si no hay parámetros
    if (empty($params)) {
        return true; // Devolver true si no hay parámetros
    }

    // Filtrar solo los parámetros permitidos
    $paramsFiltrados = array_intersect_key($params, array_flip($this->parametrosPermitidos));
   

    // Verificar si el parámetro 'pagina' es un número entero
    if (isset($paramsFiltrados['pagina']) && !ctype_digit($paramsFiltrados['pagina'])) {

        return false;
    }

    //verifica si es parámetro 
    if (isset($paramsFiltrados['autor'])) {
      
        return $paramsFiltrados;

    }

    // Verificar si algún parámetro no es válido (por ejemplo, caracteres no permitidos)
    foreach ($paramsFiltrados as $valor) {
        if (!ctype_alnum($valor)) {
            return false;
        }
    }

    // Si todos los parámetros son válidos, devolver el array filtrado
    return $paramsFiltrados;
}

}





?>