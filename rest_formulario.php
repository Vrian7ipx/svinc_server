<?php
	include_once 'FormularioEntity.php';	
	$user = isset($_GET['user'])?$_GET['user']:'';
	$pass = isset($_GET['password'])?$_GET['password']:'';
	$db = new DBmysql();
    $conn = $db->connect();
    $query = "SELECT * FROM usuarios";
    $result = $conn->query($query);    
    $valid = false;
    while($row = mysqli_fetch_assoc($result)) {
        if($row['usuario']==$user && $row['password_android']==$pass )
        	$valid =  true;
    	//print_r($row);echo "<br>";
    }


if(!$valid){
	$enviar ['respuesta'] = 0;
	$enviar ['mensaje'] = "Credenciales incorrectas";
	$enviar ['muestras']=array();
	print_r($enviar);
}
else{
	$formulario = new Formularios();
	$formularios=$formulario->getMuestras();
	$enviar = array();
	$enviar ['respuesta'] = 1;
	$enviar ['mensaje'] = "validado exitosamente";
	$enviar ['muestras']=$formularios;
	print_r($enviar);
	return json_encode($formulario->utf8ize($enviar)); 
	print_r($formularios);
	return $formularios;
}
return 0;

?>