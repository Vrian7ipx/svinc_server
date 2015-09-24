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
class DBmysql{
	//set servername
	public $servername;
	//ser username
	public $username;
	//set password
	public $password;
	//set database
	public $database;
	// Create connection
	public $Error;

	public function __construct($db = "amisis_svinc", $host = "localhost", $user = "root", $pass = ""){
		$this->database	= $db;
		$this->servername = $host;
		$this->username = $user;
		$this->password = $pass;
	}

	public function msg_error(){
		if($this->debug==true){
	        echo '
					##########################################################################################################################
					' . $this->Error . '
					##########################################################################################################################
			';
		}
        exit();
	}

	public function connect(){
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->database);	
		return $conn;
	}
	
}
?> 
