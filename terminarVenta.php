<?php
if(!isset($_POST["Total"])) exit;


session_start();


$total = $_POST["Total"];
include_once "base_de_datos.php";


$date = date("Y-m-d");
$time = time("H:i:s");



$sentencia = $base_de_datos->prepare("INSERT INTO ventas(TotalProductos, MontoTotal, Fecha,Hora,Sucursal,Vendedor) VALUES (?, ?,?, ?,?);");
$sentencia->execute([$TotalProductos,$MontoTotal, now(), now(), "LA TRADICIONAL", "VERO"]);

$sentencia = $base_de_datos->prepare("SELECT idVenta FROM ventas ORDER BY idVenta DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idVenta = $resultado === false ? 1 : $resultado->idVenta;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO detalleventa(idDetalleVenta, idPrdoducto, CantidadProductos, PrecioVenta, Total,idVenta) VALUES (?, ?, ?,?,?,?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE producto SET cantidad = Cantidad - ? WHERE idProducto = ?;");
foreach ($_SESSION["carrito"] as $producto) {
	$total += $producto->MontoTotal;
	$sentencia->execute([$producto->idProducto, $idVenta, $producto->cantidadProductos]);
	$sentenciaExistencia->execute([$producto->cantidadProductos, $producto->idVenta]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./dventa.php?status=1");
?>