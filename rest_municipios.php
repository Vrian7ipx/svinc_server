<?php
	include_once 'MunicipioEntity.php';	
	$municipio = new Municipios();
	$municipios=$municipio->getMunicipios();
	print_r($municipios);
	return $municipios;
?>