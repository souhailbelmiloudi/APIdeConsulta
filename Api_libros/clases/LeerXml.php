
<?php

class LeerXml {
    private $datos;

     public function __construct($xmlFilePath) {
        
        if (!file_exists($xmlFilePath)) {
            throw new Exception("El archivo XML especificado no existe.");
        }
        $this->datos = $this->lecturaXML($xmlFilePath);
    }

    private function lecturaXML($xmlFilePath) {
        // Lógica para leer el archivo XML y convertirlo en un array asociativo
        // Puedes usar SimpleXML o cualquier otra biblioteca XML en PHP
        $xmlData = simplexml_load_file($xmlFilePath);
        $datos = [];

        foreach ($xmlData->book as $book) {
            $datos[] = [
                'id' => (string)$book['id'],
                'autor' => (string)$book->author,
                'titulo' => (string)$book->title,
                'genero' => (string)$book->genre,
                'precio' => (float)$book->price,
                'publicacion' => (int)$book->publish_date,
                'descripcion' => (string)$book->description
              
            ];
        }

        return $datos;
    }

    public function obtenerLibros($parametros = []) {
        // Lógica para filtrar los libros según los parámetros proporcionados en la URL
        $datosObtenidos = $this->datos;

        
        if(!is_array($parametros)){
            return $datosObtenidos;
        }else{

        foreach ($parametros as $clave => $valor) {
             
            // Lógica para filtrar por clave/valor, excepto si la clave es 'pagina' y devolver un array 
            if ($clave !== 'pagina') {
                $datosObtenidos = array_filter($datosObtenidos, function ($libro) use ($clave, $valor) {
                    return stripos($libro[$clave], $valor) !== false;
                });
            }elseif(isset($parametros['pagina'])){
            $pagina = (int)$parametros['pagina'];
            $tamanioPagina = 3;
            $DatosPaginados = array_slice($datosObtenidos, $pagina * $tamanioPagina, $tamanioPagina);
            $datosObtenidos = $DatosPaginados;
            

            }
        }

        return array_values($datosObtenidos);
            
        }
       
    }
}




?>