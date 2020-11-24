<?php
if (!empty($_POST)){

	//Extrae los datos del producto
	if ($_POST['action'] == 'infoProducto')
	{
		$idProducto = $_POST['NomProducto'];

		$sentencia = mysqli_query($base_de_datos,"SELECT idProducto, Cantidad, Precio FROM producto
			                                       WHERE idProducto = $idProducto AND estatus = 1");
		mysqli_close($base_de_datos);

		$result = mysqli_num_rows($query);
		if ($result > 0){
			$data = mysqli_fetch_assoc($query);
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			exit;
		}
		echo "error";
		exit;
	}

	//Agregar productos a entrada
	if ($_POST['action'] == 'addProduct') 
	{
		if (!empty($_POST['Cantidad']) || !empty($_POST['Precio']) || !empty($_POST['idProducto'])); 
		{
			$Cantidad = $_POST['Cantidad'];
			$Precio = $_POST['Precio'];
			$idProducto = $_POST['idProducto'];
		}
	}
}

    //Eliminar producto
    if ($_POST['action'] == 'delProduct') 
    {
    	if (empty($_POST['idProducto']) || !is_numeric($_POST['idProducto'])){
    		echo "error";	    
    	}else{
    		$idProducto = $_POST['idProducto'];
    		$query_delete = mysqli_query($base_de_datos, "UPDATE Producto SET estatus idProducto");

    		mysqli_close($base_de_datos);

    		if ($query_delete) {
    			echo "ok";
    		}else{
    			echo "error";
    		}
    	}
    	echo "error";    
    exit;
   }


?>