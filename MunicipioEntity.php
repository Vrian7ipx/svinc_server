<?php 
include_once("connection/connection.php");
class Municipios
{    
    public function indexAction(){

        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT * FROM municipios";
        $result = $conn->query($query);

        //return mysqli_fetch_array($result);
        while($row = mysqli_fetch_array($result)) {
            print_r($row);
            echo "<br><br>";
        }         

    }
    public function saveAction(){
        $db = new DBmysql();
        $conn = $db->connect();
        $last_id = $conn->query("SELECT MAX(idModulo) as dato from modulos");
        $last_id = mysqli_fetch_array($last_id);        
        $last_id=$last_id['dato']+1;
        $query = "INSERT INTO modulos (idModulo,codModulo,nomModulo) VALUES (".$last_id.",'".$this->codModulo."','".$this->nomModulo."');";
        $conn->query($query);
        return 0;
    }

    public function getMunicipios()
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT cod_municipio as id, municipio as name FROM municipios";
        $result = $conn->query($query);    
        $municipios = array();

//        $query_est = "SELECT * FROM establecimientos";
        $ind = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $query_est = "SELECT idEstablecimiento as id, establecimiento as name FROM establecimientos WHERE cod_municipio = ".$row['id'];            
            $result2 = $conn->query($query_est);
            $establecimientos = array();
            while($row2 = mysqli_fetch_assoc($result2))
                array_push($establecimientos, $row2);
            $municipios[$ind]['id'] = $row['id'];
            $municipios[$ind]['name'] = $row['name'];
            $municipios[$ind]['establecimientos'] = $establecimientos; 
            //array_push($municipios, $row);
            $ind++;
        }   
        return json_encode($this->utf8ize($municipios));      
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
}
?>