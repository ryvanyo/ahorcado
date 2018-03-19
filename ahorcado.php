<?php
session_start();
if (empty($_SESSION['palabra_secreta'])) {
	$_SESSION = [
		"descripcion" => "Serie televisiva famosa donde aparecen dragones.",
		"palabra_secreta" => "juego de tronos",
		"palabra_revelada" => str_repeat(chr(0), strlen("juego de tronos")),
		"letras_usadas" => "",
		"intentos" => 0,
		"max_intentos" => 3
	];
}
extract($_SESSION, EXTR_OVERWRITE);
?><!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Ahorcado</title>
		<style>
			.guess span, .used span{
				display: inline-block;
				padding: 3px 5px;
				background-color: #FEE7B3;
			}
			.used span{
				background-color: #F1E6D4;
			}
		</style>
	</head>
	<body>
		<h1>El juego del ahorcado</h1>
		<p><?php echo $descripcion; ?></p>
		<p class="guess">
			<strong>Frase o Palabra</strong>:
			<?php
			for($i=0; $i<strlen($palabra_secreta); $i++){
				if ($palabra_secreta[$i]!=' ') {
					if ($palabra_secreta[$i]==$palabra_revelada[$i]) {
						echo '<span>'.$palabra_revelada[$i].'</span> ';
					} else {
						echo '<span></span> ';
					}
					
				} else {
					echo '&nbsp;&nbsp;';
				}
			}
			?>
		</p>
		<form action="verificar.php" method="post" >
			<p>
				<strong>Intentar letra: </strong>
				<input type="text" name="letra" maxlength="1" value="" style="width: 30px">
				<input type="submit" value="Probar">
			</p>			
		</form>
		<p>
			<strong>Intentos:</strong><?php echo "$intentos de $max_intentos"; ?>
		</p>
		<p class="used">
			<strong>Letras usadas:</strong>
			<?php
			for($i=0; $i<strlen($letras_usadas); $i++){
				echo '<span>'.$letras_usadas[$i].'</span> ';
			}
			?>
		</p>
	</body>
</html>
