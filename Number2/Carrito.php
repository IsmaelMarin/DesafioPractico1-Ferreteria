<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Verificacion.css">
    <title>Carrito de compras</title>
</head>
<body>


<div class="Compras">

<form action="PDF.php" method="POST" target="_blank">
<div class="Uno">
<h1>Carrito de compras</h1>
<?php
session_start();

?>

<?php

  $total=0;
  if(isset($_SESSION["carrito"])){
    foreach($_SESSION["carrito"] as $indice =>$arreglo){
    
        echo "<hr><h3 class='prueba'>Producto:</h3><strong>". $indice ."</strong><br>";
        //echo "<input type='text' name='btnProducto' value='$indice'>";  //NOMBRE PRODUCTO
        //$total=$total+$arreglo["Cantidad"]*$arreglo["Precio"];
        $total += $arreglo["Cantidad"]*$arreglo["Precio"];
        foreach($arreglo as $key =>$value){
            echo "<h4 class='prueba2'> $key </h4>".":". $value ."<br>";
            //echo "<input type='text' name='btnInfo' value='$key'>";      //INFORMACION
            //echo "<input type='text' name='btnvalor' value='$value'>";  //VALOR
        }
        echo "<br>";
        echo "<a class='eliminar' href='Carrito.php?item=$indice'>Eliminar Item</a><br>";
        echo "<br>";
      
    }
    echo"<hr>";
    echo"<hr>";
    echo "<br>";
    echo "<h3>El total de la compra actual es de: $total $ </h3>";
    //echo "<input type='text' name='btnTotal' value='$total'>";    //TOTAL
    echo "<div class='Especial'> ";
    echo '<a class="boton1" href="index.php">Regresar</a>
         <a  class="boton2" href="Carrito.php?vaciar=true">Vaciar Carrito</a>';
    echo "</div>";
    echo "<input type='submit' name='btnAgregar' class='boton3' value='Generar PDF'>";     


  }else if(isset($_SESSION["carrito"]) ==null){
    echo "<script>alert('El carrito esta vacío');</script>";
     ?>
     <a href="Verificacion.php">Regresar</a>
     <?php
  }
  if(isset($_REQUEST["vaciar"])){
    session_destroy();
    header("Location:Carrito.php");
  }
  if(isset($_REQUEST["item"])){
    $producto=$_REQUEST["item"];
    unset($_SESSION["carrito"][$producto]);
    header("Location:Carrito.php");
  

  }


?>
</div>
</form>

<div class="Dos">
<h1>Subir al servidor</h1>
      <form action="Carrito.php" method="post" enctype="multipart/form-data">
        <div class="mover">
        <input type="file" name="archivo" class="file1">
        <br><br>
        <input type="submit" name="btnServidor" class="file2" value="Agregar">
        </div>
      </form>
<?php
//echo "<script>alert('El archivo se ha subido exitosamente')</script>";
?>

</div>

</div>


<?php
  if(isset($_REQUEST["btnServidor"]))
  {
    $nombre=$_FILES['archivo']['name'];
    $guardado=$_FILES['archivo']['tmp_name'];
  
    if(!file_exists('Archivos')){
      mkdir('Archivos',0777,true);
      if(file_exists('Archivos')){
          if(move_uploaded_file($guardado, 'Archivos/'.$nombre)){
            echo "<script>alert('Archivo guardado con exito')</script>";
          }
          else
          {
            echo "<script>alert('Archivo no se pudo guardar)</script>";
          }
      }
    }else{
      if(move_uploaded_file($guardado, 'Archivos/'.$nombre)){
        echo "<script>alert('Archivo guardado con exito')</script>";
      }
      else
      {
        echo "<script>alert('Archivo no se pudo guardar')</script>";
      }
    }
  



     //echo "Codigo: $Codigo, producto: $Nombre, cantidad: $Cantidad, precio$: $Precio";

  }
?>
    
</body>
</html> 
 