<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Verificacion.css">
    <link href="FontAwesone/fontawesome-free-6.3.0-web/css/all.css" rel="stylesheet">
    <title>Catalogo de productos</title>
</head>
<body>
    <main class="Principal">
    <div class="Intro">
    <h1>MRN</h1>
    <h3>La ferrateria de los salvadoreños</h3>
    </div>

    <nav class="navegacion">
        <a href="#">Sobre Nosotros</a>
        <a href="#">Contáctenos</a>
        <a href=Carrito.php>
        <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </nav>

    </main>

    <div class="Contenido">
    <?php

$xml = simplexml_load_file("data.xml");
$ProductosData=$xml->productos->producto;


foreach($ProductosData as $productos){

    ?>
    <div class="Productos">
<table border="2px" class="Modelado">
  <tr>
    <td rowspan=6><img src="Imagenes/<?=$productos['image']?>" alt="Productos" width="100px" height="100px"></td>
    <th>Información</th>
    <th colspan="2">Precio</th>
 </tr>
    

      </tr>
      <td><?php echo "<h4>Codigo:</h4>" . $productos['codigo']; ?></td>
      <td rowspan="6">

        <form action="Verificacion.php" method="POST">
            <input type="hidden" name="txtcodigo" value="<?=$productos['codigo']?>">
            <input type="hidden" name="txtnombre" value="<?=$productos['nombre']?>">
            <input type="number" name="cant" class="cantidad" value="1"><br>
            <input type="hidden" name="txtPrecio" value="<?=$productos['precio']?>">
            <input type="submit" name="btnAgregar" class="boton" value="Agregar">
        </form>
      </td>
      <tr>
      <tr><td><?php echo "<h4>Nombre: </h4>". $productos['nombre']; ?></td></tr>
      <tr><td><?php echo "<h4>Descripción: </h4>". $productos['descripcion']; ?></td></tr>
      <tr><td><?php echo "<h4>Precio: </h4>". $productos['precio']. " $"; ?></td></tr>

    
  
</table>  
    </div>

<?php }?>

</div>

<?php
  if(isset($_REQUEST["btnAgregar"]))
  {
    $Codigo=$_REQUEST["txtcodigo"];
    $Nombre=$_REQUEST["txtnombre"];
    $Cantidad=$_REQUEST["cant"];
    $Precio=$_REQUEST["txtPrecio"];

    $_SESSION["carrito"][$Nombre]["Codigo"]=$Codigo;
    $_SESSION["carrito"][$Nombre]["Cantidad"]=$Cantidad;
    $_SESSION["carrito"][$Nombre]["Precio"]=$Precio;

    echo "<script>alert('Producto $Nombre agregado con éxito al carrito de compras')</script>";

     //echo "Codigo: $Codigo, producto: $Nombre, cantidad: $Cantidad, precio$: $Precio";

  }
?>


    
</body>
</html> 