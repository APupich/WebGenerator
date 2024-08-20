<?php
	session_start();
	$data = "mysql:host=localhost;dbname=webgenerator";
	$conexion = new PDO($data, 'adm_webgenerator', 'webgenerator2024');
	$consulta = $conexion->prepare("DELETE FROM webs WHERE dominio = :dominio");
    $consulta->execute(array( 'dominio' => $_GET['dominio']));
    shell_exec("rm -r webs/".$_GET['dominio']);
    header("location:panel.php"); 
?> 