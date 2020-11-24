<?php
if (!isset($_POST["idProducto"])) {
    return;
}

$idProducto = $_POST["idProducto"];
include_once "base_de_datos.php";  /*Accede a la base de datos*/
$sentencia = $base_de_datos->prepare("SELECT * FROM producto WHERE  idProducto = ? LIMIT 1;"); /*Accede a la consulta y toma el id del producto*/
$sentencia->execute([$idProducto]); /*Ejecuta la sentencia*/
$productos = $sentencia->fetch(PDO::FETCH_OBJ); /*Devuelve un objeto, en este caso la consulta donde esta el id  */
# Si no existe, salimos y lo indicamos
if (!$productos) {
    header("Location: ./vender.php?status=4"); /*Manda la alerta de que el producto no existe*/
    exit;
}
# Si no hay existencia...
if ($productos->Cantidad < 1) {
    header("Location: ./vender.php?status=5"); /*Manda la alerta de que el producto ya esta agotado*/
    exit;
}
session_start();
# Buscar producto dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->idProducto === $idProducto) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $productos->CantidadProductos = 1;
    $productos->MontoTotal = $productos->PrecioVenta;
    array_push($_SESSION["carrito"], $productos);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->CantidadProductos;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $productos->Cantidad) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->CantidadProductos++;
    $_SESSION["carrito"][$indice]->MontoTotal = $_SESSION["carrito"][$indice]->CantidadProductos * $_SESSION["carrito"][$indice]->Precio;
}
header("Location: ./vender.php");
