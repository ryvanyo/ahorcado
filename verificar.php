<?php
session_start();

function is_game_over(){
	if ($_SESSION['intentos']>=$_SESSION['max_intentos']) {
		header("Location: game_over.php");
		exit();
	}
}

is_game_over();

$letra = $_POST['letra'][0];

$pos = strpos($_SESSION['palabra_secreta'], $letra);
if ($pos===false) {
	//no se encontro la letra en la palabra secreta
	$_SESSION['intentos']++;
	is_game_over();
}

$_SESSION['letras_usadas'] .= $letra;
for($i=0; $i<strlen($_SESSION['palabra_secreta']); $i++){
	if ($_SESSION['palabra_secreta'][$i]==$letra) {
		$_SESSION['palabra_revelada'][$i] = $letra;
	}
}

header("Location: ahorcado.php");