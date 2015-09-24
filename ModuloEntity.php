<?php
/*------------------------------------*\
    Crea Tu Mundo
\*------------------------------------*/

/*------------------------------------*\
    Proyect     : Android App SVINC  
    Description : Modulos Entity
    Developer   : Brian Barrera
    E - mail    : brian[at]creatumundo.com.bo
    Filename    : ModeloEntity.php
    Version     : 1.0
    Date        : August 2015
\*------------------------------------*/

include_once("connection/connection.php");
/**
 * Modulos
 */
class Modulos
{
    /**
     * @var string
     */
    private $codModulo;

    /**
     * @var string
     */
    private $nomModulo;

    /**
     * @var string
     */
    private $idModulo;


    /**
     * Set codmodulo
     *
     * @param string $codmodulo
     * @return Modulos
     */
    public function setCodModulo($codModulo)
    {
        $this->codModulo = $codModulo;

        return $this;
    }

    /**
     * Get codmodulo
     *
     * @return string 
     */
    public function getCodModulo()
    {
        return $this->codModulo;
    }

    /**
     * Set nommodulo
     *
     * @param string $nommodulo
     * @return Modulos
     */
    public function setNomModulo($nomModulo)
    {
        $this->nomModulo = $nomModulo;

        return $this;
    }

    /**
     * Get nommodulo
     *
     * @return string 
     */
    public function getNomModulo()
    {
        return $this->nomModulo;
    }

    /**
     * Get idmodulo
     *
     * @return string 
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }
/*
    public function __construct(id = 0 )
    {
        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT * FROM modulos where id = '".id."'";
        $result = $conn->query($query);

        while($row = mysqli_fetch_array($result)) {
            print_r($row);
            echo "<br><br>";
        }         
    }*/
    public function indexAction(){

        $db = new DBmysql();
        $conn = $db->connect();
        $query = "SELECT * FROM modulos";
        $result = $conn->query($query);
        return mysqli_fetch_array($result);
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
}
