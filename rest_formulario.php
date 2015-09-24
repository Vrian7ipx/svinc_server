<?php
	include_once 'FormularioEntity.php';	
	$formulario = new Formularios();
	$formularios=$formulario->getFormularios();
	print_r($formularios);
	return $formularios;
?>