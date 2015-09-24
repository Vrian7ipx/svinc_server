<?php 

	include_once 'RestEntity.php';
	//include_once 'MunicipioEntity.php';
	include_once 'FormularioEntity.php';
	$rest = new rest;

	if (getGet('test') == 1) {
	    //$rest->saveRedord('nhhh', '-64', '-32', '1391701813');
	    $rest->saveEncuesta();
	}

	//	$rest->rating();
	if(isset($_GET['id']))
		$indice = $_GET['id'];
	else
		$indice = $_POST['id'];

	$formulario = new Formularios();
	$formulario=$formulario->getFormulario($indice);
	//getMunicipios();
	print_r($formulario);
	function getGet($var) {
	    if (isset($_GET[$var])) {
	        return $_GET[$var];
	    } else {
	        return '';
    	}
	}
?>