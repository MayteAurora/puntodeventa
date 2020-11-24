<?php include_once "encabezado.php"?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM detalleventa;");
$detalleventa = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM producto;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>




<section id="container">
	<div class="title_page">
		<h1>DETALLE DE VENTA</h1>
	</div>


<?php 
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>

	<div class="col-xs-12">
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Venta realizada correctamente
						</div>
					<?php
				}else if($_GET["status"] === "2"){
					?>
					<div class="alert alert-info">
							<strong>Venta cancelada</strong>
						</div>
					<?php
				}else if($_GET["status"] === "3"){
					?>
					<div class="alert alert-info">
							<strong>Ok</strong> Producto quitado de la lista
						</div>
					<?php
				}else if($_GET["status"] === "4"){
					?>
					<div class="alert alert-warning">
							<strong>Error:</strong> El producto que buscas no existe
						</div>
					<?php
				}else if($_GET["status"] === "5"){
					?>
					<div class="alert alert-danger">
							<strong>Error: </strong>El producto está agotado
						</div>
					<?php
				}else{
					?>
					<div class="alert alert-danger">
							<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
						</div>
					<?php
				}
			}
		?>
		<br>


<section class="form-prod">
<form method="post" action="">

	<h4>Nueva Venta</h4>
	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<form method="post" action="agregarAlCarrito.php">
			<label for="idProducto">ID del Producto:</label>
			<input autocomplete="off" autofocus class="form-control" name="idProducto" required type="text" id="idProducto" placeholder="Escribe el id">

			<label for="CantidadProductos">Cantidad:</label>
			<input autocomplete="off" autofocus class="form-control" name="CantidadProductos" required type="text" id="CantidadProductos" placeholder="Cantidad de Productos">
		</form>
		<br><br>


<table class="tdv" border="1" bgcolor="#F6F940">
	<thead>
		<tr>
			<td bgcolor="#53F5BC">ID de Venta</td>
		    <td bgcolor="#53F5BC">ID del Producto</td>
		    <td bgcolor="#53F5BC">Nombre del Producto</td>
		    <td bgcolor="#53F5BC">Cantidad Productos</td>
		    <td bgcolor="#53F5BC">Precio de Venta</td>
		    <td bgcolor="#53F5BC">Total</td>
		    <td bgcolor="#53F5BC">ID de Venta</td>
		    <td bgcolor="#53F5BC">Eliminar</td>
		</tr>
	</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $DetalleVenta){ 
						$granTotal += $DetalleVenta->MontoTotal;
					?>
					<?php

$sentencia="SELECT * FROM Producto";

?>

				<?php } ?>
			</tbody>

		<form action="./terminarVenta.php" method="POST">
			<input name="MontoTotal" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
	</div>
<?php include_once "pie.php" ?>


















<?php

$sentencia="SELECT * FROM DetalleVenta";

?>
			
			<tbody>
				<?php foreach($detalleventa as $detalleventa){ ?>

				<tr>
					<td><?php echo $detalleventa->idDetalleVenta ?></td>
					<td><?php echo $detalleventa->idProducto ?></td>
					<td><?php echo $productos->NomProducto ?></td>
					<td><?php echo $detalleventa->CantidadProductos ?></td>
					<td><?php echo $detalleventa->PrecioVenta ?></td>
					<td><?php echo $detalleventa->Total ?></td>
					<td><?php echo $detalleventa->idVenta ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?idDetalleVenta=" . $producto->idDetalleVenta?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</

<?php include_once "pie.php"?>
</section>

