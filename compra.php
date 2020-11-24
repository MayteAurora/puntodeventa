<?php 
session_start();
include_once "encabezado.php";
if(!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
	<div class="col-xs-12">
		<h1>DETALLE DE COMPRA</h1>
		<?php
			if(isset($_GET["status"])){
				if($_GET["status"] === "1"){
					?>
						<div class="alert alert-success">
							<strong>¡Correcto!</strong> Compra realizada correctamente
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
							<strong>Ok</strong> Producto eliminado de la lista
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
		<form method="post" action="agregarAlCarrito.php">
			<label class="id" for="idProducto">ID PRODUCTO:</label>
			<input autocomplete="off" autofocus class="form-control" name="idProducto" required type="text" id="idProducto" placeholder="Ingresa el ID del producto">
		</form>
		<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>NOMBRE</th>
					<th>CATEGORIA</th>
					<th>TALLA</th>
					<th>MARCA</th>
					<th>PRECIO</th>
					<th>CANTIDAD</th>
					<th>COLOR</th>
					<th>MATERIAL</th>
					<th>TEMPORADA</th>
					<th>ELIMINAR</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($_SESSION["carrito"] as $indice => $producto){ 
						$granTotal += $producto->Precio;
					?>
				<tr>
					<td><?php echo $producto->NomProducto ?></td>
					<td><?php echo $producto->Categoria?></td>
					<td><?php echo $producto->Talla ?></td>
					<td><?php echo $producto->Marca ?></td>
					<td><?php echo $producto->Precio ?></td>
					<td><?php echo $producto->Cantidad ?></td>
					<td><?php echo $producto->Color ?></td>
					<td><?php echo $producto->Material?></td>
					<td><?php echo $producto->Temporada ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

		<h3>Total: <?php echo $granTotal; ?></h3>
		<form action="./terminarVenta.php" method="POST">
			<input name="total" type="hidden" value="<?php echo $granTotal;?>">
			<button type="submit" class="btn btn-success">Terminar venta</button>
			<a href="./cancelarVenta.php" class="btn btn-danger">Cancelar venta</a>
		</form>
	</div>
<?php include_once "pie.php" ?>