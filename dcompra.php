<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentenciadc = $base_de_datos->query("SELECT * FROM detallecompra;");
$detallecompra = $sentenciadc->fetchAll(PDO::FETCH_OBJ);
?>

<section id="container">
	<div class="title_page">
		<h1>DETALLE DE COMPRA</h1>
	</div>

<section class="form-prod">
	<form method="post">

	<h4>Ingresa Nueva Compra</h4>


		<label for="idProducto">ID del Producto:</label>
			<input autocomplete="off" autofocus class="form-control" name="idProducto" required type="text" id="idProducto" placeholder="Escribe el id">

		
		<label for="existencia">Precio:</label>
		<input class="form-control" type="number" name="Precio" required type="number" id="Precio" placeholder="Ingrese Precio">
		 
		<label for="existencia">Cantidad:</label>
		<input class="form-control" type="number" name="Cantidad" required type="number" id="Cantidad" placeholder="Ingrese Cantidad">
		
		
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</section>

<table border="1" bgcolor="#F6F940">
	<thead>
		<tr>
		    <td bgcolor="#53F5BC">ID de Detalle de Compra</td>
		    <td bgcolor="#53F5BC">ID Producto</td>
		    <td bgcolor="#53F5BC">Cantidad de Productos</td>
		    <td bgcolor="#53F5BC">Precio de Compra</td>
		    <td bgcolor="#53F5BC">Total de Compra</td>
		    <td bgcolor="#53F5BC">ID de Compra</td>
		    <td bgcolor="#53F5BC">Eliminar</td>
		</tr>
	</thead>


<?php

$sentenciadc="SELECT * FROM DetalleCompra";

?>
			
			<tbody>
				<?php foreach($DetalleCompra as $DetalleCompra){ ?>

				<tr>
					<td><?php echo $detallecompra->idDetalleCompra ?></td>
					<td><?php echo $detallecompra->idProducto ?></td>
					<td><?php echo $detallecompra->CantidadProd ?></td>
					<td><?php echo $detallecompra->PrecioCompra ?></td>
					<td><?php echo $detallecompra->TotalCompra ?></td>
					<td><?php echo $detallecompra->idCompra ?></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?idDetalleCompra=" . $producto->idDetalleCompra?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</

<?php include_once "pie.php"?>


</section>