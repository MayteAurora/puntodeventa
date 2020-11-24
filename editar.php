<?php
if(!isset($_GET["id"])) exit();
$id = $_GET["id"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM producto WHERE idProducto = ?;");
$sentencia->execute([$id]);
$producto = $sentencia->fetch(PDO::FETCH_OBJ);
if($producto === FALSE){
	echo "¡No existe algún producto con ese ID!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
<h1 class="tep">EDITAR PRODUCTO</h1>

	<div class="col-xs-12">
		<section class="form-prod-edit">
		<h1>Editar producto con el ID <?php echo $producto->idProducto; ?></h1>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="id" value="<?php echo $producto->idProducto; ?>">
	
			<label for="codigo">ID Producto:</label>
			<input value="<?php echo $producto->idProducto ?>" class="form-control" name="idProducto" required type="text" id="idProducto" placeholder="Escribe el id">

			<label for="descripcion">Nombre del producto:</label>
            <input value="<?php echo $producto->NomProducto?>" class="form-control" name="NomProducto" required type="varchar" id="NomProducto" placeholder="Ingresa el nombre">

			<label for="precioVenta">Categoria:</label>
			<input value="<?php echo $producto->Categoria?>" class="form-control" name="Categoria" required type="varchar" id="Categoria" placeholder="Ingrese Categoria">

			<label for="precioCompra">Talla:</label>
			<input value="<?php echo $producto->Talla ?>" class="form-control" name="Talla" required type="varchar" id="Talla" placeholder="Ingrese talla">

			<label for="existencia">Marca:</label>
			<input value="<?php echo $producto->Marca ?>" class="form-control" name="Marca" required type="varchar" id="Marca" placeholder="Ingrese Marca">
			
			<label for="existencia">Precio:</label>
			<input value="<?php echo $producto->Precio ?>" class="form-control" name="Precio" required type="number" id="Precio" placeholder="Ingrese Precio">
			
			<label for="existencia">Cantidad:</label>
			<input value="<?php echo $producto->Cantidad ?>" class="form-control" name="Cantidad" required type="number" id="Cantidad" placeholder="Ingrese Cantidad">
			
			<label for="existencia">Color:</label>
			<input value="<?php echo $producto->Color ?>" class="form-control" name="Color" required type="varchar" id="Color" placeholder="Ingrese Color">
			
			<label for="existencia">Material:</label>
			<input value="<?php echo $producto->Material ?>" class="form-control" name="Material" required type="varchar" id="Material" placeholder="Ingrese Material">
			
			<label for="existencia">Temporada:</label>
			<input value="<?php echo $producto->Temporada ?>" class="form-control" name="Temporada" required type="varchar" id="Temporada" placeholder="Ingrese Temporada">
			
			

			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./listar.php">Cancelar</a>
		</form>
	</section>
	</div>

<?php include_once "pie.php" ?>
