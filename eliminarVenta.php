<?php
if(!isset($_GET["idProducto"])) exit();
$idProducto = $_GET["idProducto"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM Ventas WHERE idProducto = ?;");
$resultado = $sentencia->execute([$idProducto]);
if($resultado === TRUE){
	header("Location: ./dventa.php");
	exit;
}
else echo "Algo salió mal";
?>