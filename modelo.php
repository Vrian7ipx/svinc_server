<?php
/*------------------------------------*\
    Crea Tu Mundo
\*------------------------------------*/

/*------------------------------------*\
    Proyect     : Android App SVINC  
    Description : connect to database
    Developer   : Brian Barrera
    E - mail    : brian[at]creatumundo.com.bo
    Filename    : connection.php
    Version     : 1.0
    Date        : August 2015
\*------------------------------------*/
include_once("ModuloEntity.php");
$modulo = new Modulos();
//$modulo->setIdModulo("M5");
$modulo->setCodModulo("M6");
$modulo->setNomModulo("Modulo6");
$modulos = $modulo->indexAction();
while($row = $modulos) {
            print_r($row);
            echo "<br><br>";
        }
print_r($modulos);
//$modulo->saveAction();


?>