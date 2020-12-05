<?php
	$output = array();
	include_once 'config/conexion.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();

    $statement = $conexion->prepare(
            "SELECT * FROM art  WHERE idart = '".$_GET["idart"]."' 
            LIMIT 1"
        );
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["foto"] = $row["foto"];
	}
	echo json_encode($output);
    $link= null;
?>