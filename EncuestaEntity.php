<?php
	include_once 'connection/connection.php';
	class Encuesta{
		public $id;
		public $idForm;
		public $idMuestra;
		public $idMunicipio;
		public $idEstablecimiento;
		public $idAreaSupervision;
		//public idEncuesta;
		public $fechaEncuesta;
		public $resultados;
		public $idUsuario;
		public $phone;

		public function __construct($idf=0,$idmue=0,$idmun=0,$ide=0,$ida, $fec='',$res='',$idu=0)
		{
			$this->idForm = $idf;
			$this->idMuestra = $idmue; 
			$this->idMunicipio = $idmun;
			$this->idEstablecimiento = $ide;
			$this->idAreaSupervision = $ida;
			$this->fechaEncuesta = $fec;
			$this->resultados = $res;
			$this->idUsuario = $idu;			
		}
		public function saveAction(){
	        $db = new DBmysql();
	        $conn = $db->connect();
	        $last_id = $conn->query("SELECT MAX(ide) as dato from encuestas");
	        $last_id = mysqli_fetch_array($last_id);        
	        $last_id=$last_id['dato']+1;
	        $val1 =1;
	        $query = "INSERT INTO encuestas (".
	        	"ide,".
	        	"idForm,".
	        	"idMuestra,".
	        	"cod_municipio,".
	        	"idEstablecimiento,".
	        	"idAreaSupervision,".
	        	"fechaencuesta,".
	        	"resultados,".
	        	"cod_usuario,".
	        	"phone".
	        	") VALUES (".
	        	$last_id.",".
	        	$this->idForm.",".
	        	$this->idMuestra.",".
	        	$this->idMunicipio.",".
	        	$this->idEstablecimiento.",".
	        	$this->idAreaSupervision.",'".
	        	$this->fechaEncuesta."','".
	        	$this->resultados."	',".
	        	$this->idUsuario.",".
	        	$val1.");";		
	        	echo $query;	
	        $conn->query($query);
	        return 0;
    	}

	}
?>