<?php
if(!isset($_GET["idProducto"])) exit();
$id = $_GET["idProducto"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM producto WHERE idProducto = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal";
?>