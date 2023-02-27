<?php
session_start();

?>

<?php

require_once __DIR__ . '/vendor/autoload.php';

//Grab variables



//Nueva instancia
$mpdf = new \Mpdf\Mpdf();


//Create PDF

$data = '';
$data .= '<h1>Cotización de productos</h1>';

//Add data
$total=0;
  if(isset($_SESSION["carrito"])){
    foreach($_SESSION["carrito"] as $indice =>$arreglo){
         $data .= '<strong>Producto</strong> ' .$indice .'<br />';
         $total += $arreglo["Cantidad"]*$arreglo["Precio"];
    foreach($arreglo as $key =>$value){
       $data .=  $key. ' : ' .$value .'<br/>';
       
    }
    $data .= '<br>';
}   
    $data .= '<hr>';
    $data .= '<strong>Total:</strong> ' .$total .'$'.'<br />';
    $data .= '<hr>';
  }


$mpdf->WriteHTML($data);
$mpdf->Output('myfile.pdf','D');
?>
