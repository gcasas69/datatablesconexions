<?php
include_once 'config/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM articulos";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$articulos=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php+foreach</title>
    <link rel="stylesheet" href="./css/output.css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <style>
        .dataTables_filter {margin-bottom: 10px;}
    </style>
</head>

<body class="h-screen">
    <div class="bg-gray-200 text-xs font-rale font-hairline m-5 p-2 rounded">
        <table id="tablaArticulos" class="display bg-gray-400 text-sm" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>codigo</th>
                    <th>articulo</th>
                    <th>categoria</th>
                    <th>ubicación</th>
                    <th>proveedor</th>
                    <th>medida1</th>
                    <th>precio1</th>
                    <th>medida2</th>
                    <th>precio2</th>
                    <th>medida3</th>
                    <th>precio3</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($articulos as $articulo){
                ?>
                <tr>
                    <td><?php echo $articulo['idart']?></td>
                    <td><?php echo $articulo['codigo']?></td>
                    <td><?php echo $articulo['articulo']?></td>
                    <td><?php echo $articulo['categoria']?></td>
                    <td><?php echo $articulo['ubicacion']?></td>
                    <td><?php echo $articulo['proveedor']?></td>
                    <td><?php echo $articulo['m1']?></td>
                    <td><?php echo $articulo['v1']?></td>
                    <td><?php echo $articulo['m2']?></td>
                    <td><?php echo $articulo['v2']?></td>
                    <td><?php echo $articulo['m3']?></td>
                    <td><?php echo $articulo['v3']?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <script>
      $(document).ready(function(){
         $('#tablaArticulos').DataTable(); 
      });
    </script>
</body>

</html>