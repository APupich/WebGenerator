<?php
	session_start();
	if (isset($_SESSION['usuario'])) {
		header("location:panel.php");
	}
	$error = "";
	$submit = false;
	if (isset($_POST['submit'])) {
		$submit = $_POST['submit'];
		if (isset($_POST['email']) && isset($_POST['password']) ) {
			if ($_POST['email'] == 'admin@server.com' && $_POST['password'] == 'serveradmin') {
			$_SESSION['usuario'] = 'admin';
			header('location:panel.php');
		} 
		}
		
	}
	if ($submit && isset($_POST['email']) && isset($_POST['password'])) {
		$data = "mysql:host=localhost;dbname=webgenerator";
		$conexion = new PDO($data, 'adm_webgenerator', 'webgenerator2024');
  		$consulta = $conexion->prepare("SELECT idUsuario,email,password FROM usuarios WHERE email = :email ");
	    $consulta->execute(array( 'email' => $_POST['email']));
	    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
	    $error = "usuario no encontrado";
	    if ($usuario) {
				$error = "constraseña incorrecta";
	    	if ($usuario['password'] == $_POST['password']) {
		    	$_SESSION['usuario'] = $usuario['idUsuario'];
		    	header("location:panel.php");
	    	}
	    }
	    
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>webgenerator</title>
</head>
<body>
	<h1>WebGenerator Agustin Pupich</h1>
	<form method="post">
		Email: <input type="text" name="email"><br>
		Contraseña: <input type="password" name="password"><br>
		<input type="submit" name="submit" value="Ingresar">
		<a href="register.php">Registrarse</a> <br>	
		<?= $error ?>
	</form>
</body>
</html>