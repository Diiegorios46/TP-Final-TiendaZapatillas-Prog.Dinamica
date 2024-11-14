<?php 
include '../estructura/cabecera.php';
$bd = new BaseDatos();
$datos = data_submitted();
?>

<body>
<h2 class="upload-title">Subir un nuevo producto.</h2>
<?php
  if (isset($_GET['success']) && $_GET['success']) {
    echo '<p class="upload-success">Producto subido correctamente.</p>';
  } else if (isset($_GET['success']) && !$_GET['success']) {
    echo '<p class="upload-error">Error al subir el producto.</p>';
  }
?>

<form action="./agregarAction.php" method="post" enctype="multipart/form-data" class="upload-form">
  <div class="form-group">
    <label for="pronombre" class="form-label">Nombre del producto</label>
    <input type="text" name="pronombre" id="pronombre" class="form-input" required>
  </div>
  <div class="form-group">
    <label for="proprecio" class="form-label">Precio del producto</label>
    <input type="number" name="proprecio" id="proprecio" class="form-input" required>
  </div>
  <div class="form-group">
    <label for="promarca" class="form-label">Marca del producto</label>
    <select name="promarca" id="promarca" class="form-select" required>
      <option value="nike">Nike</option>
      <option value="adidas">Adidas</option>
      <option value="vans">Vans</option>
      <option value="dc">DC</option>
      <option value="topper">Topper</option>
    </select>
  </div>

  <div class="form-group">
    <label for="prodetalle" class="form-label">Detalle del producto</label>
    <input type="text" name="prodetalle" id="prodetalle" class="form-input" required>
  </div>
  <div class="form-group">
    <label for="procantstock" class="form-label">Cantidad de stock</label>
    <input type="number" name="procantstock" id="procantstock" class="form-input" required>
  </div>
  <div class="form-group">
    <label for="image" class="form-label">Choose image(s) to upload:</label>
    <input type="file" name="image[]" id="image" class="form-file" multiple required>
  </div>

  <input type="submit" value="Subir imagen" name="submit" class="form-submit">
</form>
</body>
</html>
<?php

/** */