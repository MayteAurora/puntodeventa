<h1>PUNTO DE VENTA</h1>
<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM producto;");
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>


		<section class="form-prod">
<form method="post" action="nuevo.php">

	<h4>Ingresar Nuevo Producto</h4>
	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<label for="codigo">ID del Producto:</label>
		<input class="form-control" name="idProducto" required type="number" id="idProducto" placeholder="Ingresa el id">

		<label for="descripcion">Nombre del Producto:</label>
		<input class="form-control" name="NomProducto" required type="text" id="NomProducto" placeholder="Ingresa el nombre del producto">

		<label for="precioVenta">Categoría:</label>
		<input class="form-control" name="Categoria" required type="varchar" id="Categoria" placeholder="Ingrese Categoria">

		<label for="precioCompra">Talla:</label>
		<input class="form-control" name="Talla" required type="varchar" id="Talla" placeholder="Ingresa Talla">

		<label for="existencia">Marca:</label>
		<input class="form-control" name="Marca" required type="varchar" id="Marca" placeholder="Ingrese Marca">
		
		<label for="existencia">Precio:</label>
		<input class="form-control" name="Precio" required type="number" id="Precio" placeholder="Ingrese Precio">
		 
		<label for="existencia">Cantidad:</label>
		<input class="form-control" name="Cantidad" required type="number" id="Cantidad" placeholder="Ingrese Cantidad">
		
		<label for="existencia">Color:</label>
		<input class="form-control" name="Color" required type="varchar" id="Color" placeholder="Ingrese Color">
		
		<label for="existencia">Material:</label>
		<input class="form-control" name="Material" required type="varchar" id="Material" placeholder="Ingrese Material">
		
		<label for="existencia">Temporada:</label>
		<input class="form-control" name="Temporada" required type="varchar" id="Temporada" placeholder="Ingrese Temporada">
		
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>

</section>

<table border="1" bgcolor="#F6F940">
	<thead>
		<tr>
		    <td bgcolor="#53F5BC">ID del Producto</td>
		    <td bgcolor="#53F5BC">Nombre del Producto</td>
		    <td bgcolor="#53F5BC">Categoria</td>
		    <td bgcolor="#53F5BC">Talla</td>
		    <td bgcolor="#53F5BC">Marca</td>
		    <td bgcolor="#53F5BC">Precio</td>
		    <td bgcolor="#53F5BC">Cantidad</td>
		    <td bgcolor="#53F5BC">Color</td>
		    <td bgcolor="#53F5BC">Material</td>
		    <td bgcolor="#53F5BC">Temporada</td>
		    <td bgcolor="#53F5BC">Editar</td>
		    <td bgcolor="#53F5BC">Eliminar</td>
		</tr>
	</thead>


<?php

$sentencia="SELECT * FROM Producto";

?>
			
			<tbody>
				<?php foreach($productos as $producto){ ?>

				<tr>
					<td><?php echo $producto->idProducto ?></td>
					<td><?php echo $producto->NomProducto ?></td>
					<td><?php echo $producto->Categoria?></td>
					<td><?php echo $producto->Talla ?></td>
					<td><?php echo $producto->Marca ?></td>
					<td><?php echo $producto->Precio ?></td>
					<td><?php echo $producto->Cantidad ?></td>
					<td><?php echo $producto->Color ?></td>
					<td><?php echo $producto->Material?></td>
					<td><?php echo $producto->Temporada ?></td>
					<td><a class="btn btn-warning" href="<?php echo "editar.php?id=" . $producto->idProducto?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?idProducto=" . $producto->idProducto?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</

<?php include_once "pie.php"?>