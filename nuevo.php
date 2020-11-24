<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["idProducto"]) || !isset($_POST["NomProducto"]) || !isset($_POST["Categoria"]) || !isset($_POST["Talla"]) || !isset($_POST["Marca"]) || !isset($_POST["Precio"])|| !isset($_POST["Cantidad"])|| !isset($_POST["Color"])|| !isset($_POST["Material"]) || !isset($_POST["Temporada"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$idProducto = $_POST["idProducto"];
$NomProducto = $_POST["NomProducto"];
$Categoria = $_POST["Categoria"];
$Talla = $_POST["Talla"];
$Marca = $_POST["Marca"];
$Precio = $_POST["Precio"];
$Cantidad = $_POST["Cantidad"];
$Color = $_POST["Color"];
$Material = $_POST["Material"];
$Temporada = $_POST["Temporada"];


$sentencia = $base_de_datos->prepare("INSERT INTO producto(idProducto, NomProducto, Categoria, Talla, Marca, Precio, Cantidad, Color, Material, Temporada) VALUES (?, ?, ?, ?, ?,?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$idProducto, $NomProducto, $Categoria, $Talla, $Marca, $Precio, $Cantidad, $Color, $Material, $Temporada]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>