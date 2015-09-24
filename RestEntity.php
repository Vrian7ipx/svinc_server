<?php
include_once 'EncuestaEntity.php';
class rest{
	private $encuesta = array();
	public function __construct()
	{

	}

	public function saveEncuesta(){
		$encuesta = new Encuesta(1,1,1,1,'20/08/2015','1|2|3',1);
		$encuesta->saveAction();
	}
}
?>