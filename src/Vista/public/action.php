<?php
include '../estructura/cabecera.php';
$bd = new BaseDatos();

$datos = data_submitted();
$producto = new abmProducto();

echo "<div class='container-fluid shadow'>";
echo "<div class='container-sm d-flex gap border border-dark '>";
if (isset($datos['submit'])) {
   foreach ($datos['image']['tmp_name'] as $imagen) {
      echo '<img src="data:image/jpeg;base64,' . base64_encode(file_get_contents($imagen)) . '" />';
      $codigoImagen[] = base64_encode(file_get_contents($imagen));
   }
}

echo "</div>";
echo "</div>";
?>
