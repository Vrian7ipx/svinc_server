<?php 
include_once 'EncuestaEntity.php';
//$form=$_GET["form"];
//$est=$_GET["est"];
//$res=$_GET["res"];
//saveEncuesta($form,$est,$res);
$dato = $_GET['dato'];
$dato = json_decode($dato);
$municipio = $establecimiento = $area_supervision = 0;
switch ($dato->ubicacion_tipo) {
	case 1:
		$municipio = $dato->ubicacion;
		break;
	case 2:
		$establecimiento  = $dato->ubicacion;
		break;
	case 3:
		$area_supervision = $dato->ubicacion;
		break;	
}
$date = $dato->date;
print_r($dato);


saveEncuesta($dato->formulario,$municipio,$establecimiento,$area_supervision,$date,$dato->resultado,$dato->usuario);

function saveEncuesta($form,$municipio,$establecimiento,$area_supervision,$date,$resultado,$user){
	
		$encuesta = new Encuesta($form,0,$municipio,$establecimiento,$area_supervision,$date,$resultado,$user);
		$encuesta->saveAction();
	}
?>
