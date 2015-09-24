<?php 
include_once("connection/connection.php");

class Formularios
{
 	public function getFormularios()
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT idForm as id, nomFormulario as name FROM formulario";
        $result = $conn->query($query);    
        $formularios = array();                
        while($row = mysqli_fetch_assoc($result)) {            
             array_push($formularios, $row);     
        }   
        return json_encode($this->utf8ize($formularios));  
    } 
    function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = $this->utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
    }
    public function getFormulario($idsend)
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT idform as id, nomFormulario as name FROM formulario WHERE idform =".$idsend;         
        $result = $conn->query($query);  
        $formulario=array();
        while($row = mysqli_fetch_assoc($result)) {            
            $formulario ['id'] = $row ['id'];
            $formulario ['name'] = $row ['name'];
            $formulario ['secciones'] = $this->getSecciones($idsend);
        }
        return json_encode($this->utf8ize($formulario));
    }

    private function getSecciones($idsend)
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $seccion_query = "SELECT idseccion as id, nomseccion as name FROM seccion WHERE idform = ".$idsend." GROUP BY secuencial";
        $seccion_result = $conn->query($seccion_query);  
        $secciones = array();
        $ind = 0;
        while($seccion_row = mysqli_fetch_assoc($seccion_result))                
        {
            $secciones [$ind]['id'] = $seccion_row ['id'];
            $secciones [$ind]['name'] = $seccion_row ['name'];
            $secciones [$ind]['subseccion'] = $this->getSubSecciones($seccion_row ['id']);
            $ind++;
        }             
        return $secciones;
    }

    private function getSubSecciones($idsend)
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT idSubSeccion as id, nomSubSeccion as name FROM subseccion WHERE idSeccion =".$idsend." GROUP BY secuencial";    
        //echo $query;
        $result = $conn->query($query);  
        $sub_seccion=array();
        $ind  = 0;
        while($row = mysqli_fetch_assoc($result)) {            
            $sub_seccion [$ind]['id'] = $row ['id'];
            $sub_seccion [$ind]['name'] = $row ['name'];            
            $sub_seccion [$ind]['preguntas'] = $this->getPreguntas($row ['id']);
            $ind++;
        }
        return $sub_seccion;    
    }
    private function getPreguntas($idsend)
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT idPregunta as id, nomPregunta as name, idTipoRespuesta as obligatorio FROM preguntas WHERE idSubSeccion =".$idsend." GROUP BY secuencial";         
        $result = $conn->query($query);  
        $pregunta=array();
        $ind  = 0;
        while($row = mysqli_fetch_assoc($result)) {                        
            
            $pregunta [$ind]['id'] = $row ['id'];
            $pregunta [$ind]['name'] = $row ['name'];
            $pregunta [$ind]['obligatorio'] = ($row ['obligatorio'] == 1?1:0);

            $query_respuesta = "SELECT idDatoEsperado as id FROM respuestas WHERE idpregunta =".$row['id'];
            $result_respuesta = $conn->query($query_respuesta);
            while( $row_respuesta = mysqli_fetch_assoc($result_respuesta))
                $pregunta [$ind]['esperado'] = $row_respuesta ['id'];

            $query_valores = "SELECT idListaValor as id, descripcion as name, valor FROM listavalores WHERE idpregunta =".$row['id']." ORDER BY secuencial";
            $result_valores = $conn->query($query_valores);
            $valores = array();
            $ind_val = 0;
            while ( $row_valores = mysqli_fetch_assoc($result_valores)) {
                $valores[$ind_val]['id'] =  $row_valores['id'];
                $valores[$ind_val]['name'] = $row_valores['name'];
                $valores[$ind_val]['value'] = $row_valores['valor'];
                $ind_val++;
            }
            $pregunta [$ind]['valores'] = $valores;
            $pregunta [$ind]['restricciones'] = $this->getRestricciones($row ['id']);

            $ind++;
        }
        return $pregunta;        
    }
    private function getRestricciones($idsend)
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT idRestriccion as id, idPreguntaDestino as destino, idListaValor as valor FROM restricciones WHERE idpregunta =".$idsend;         
        $result = $conn->query($query);  
        $restricciones = array();
        $ind  = 0;
        while($row = mysqli_fetch_assoc($result)) {            
            $restricciones [$ind]['id'] = $row ['id'];
            $restricciones [$ind]['destino'] = $row ['destino'];            
            $restricciones [$ind]['valor'] = $row ['valor'];                
            $ind++;
        }
        return $restricciones;    
    }
}