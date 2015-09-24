<?php
	include_once 'FormularioEntity.php';	
	include_once 'MunicipioEntity.php';	
	$formulario = new Formularios();
	$formularios=$formulario->getFormularios();
		
	$municipio = new Municipios();
	$municipios=$municipio->getMunicipios();
	
	$mun = json_decode($municipios);
	$for = json_decode($formularios);
	$dato = array();
	$dato["municipios"]= $mun;
	$dato["formularios"]=$for;

	$dato = json_encode($dato);
	print_r($dato);
	return $dato;	
?>