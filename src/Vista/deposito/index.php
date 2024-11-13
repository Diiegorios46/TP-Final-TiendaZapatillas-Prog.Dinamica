<?php 
include '../estructura/cabecera.php';
$bd = new BaseDatos();
$datos = data_submitted();
?>

<body>
  
  <h2>Upload Image</h2>

  <form action="./action.php" method="post" enctype="multipart/form-data">
    <label for="pronombre">Nombre Del producto</label>
    <input type="text" name="pronombre" id="pronombre" required>
    <br>
    <label for="proprecio">Precio del producto</label>
    <input type="number" name="proprecio" id="proprecio" required>
    <br>
    <label for="promarca">Marca del producto</label>
    <select name="promarca" id="promarca">
        <option value="nike">Nike</option>
        <option value="adidas">Adidas</option>
        <option value="vans">Vans</option>
        <option value="dc">DC</option>
        <option value="topper">Topper</option>
    </select>

    <br>
    <label for="prodetalle">Detalle del producto</label>
    <input type="text" name="prodetalle" id="prodetalle" required>
    <br>
    <label for="procantstock">Cantidad de stock</label>
    <input type="number" name="procantstock" id="procantstock" required>
    <br>
    <label for="image">Choose image(s) to upload:</label>
    <input type="file" name="image[]" id="image" multiple required>
    <br><br>
    <input type="submit" value="Upload Image" name="submit">
  </form>
  
</body>
</html>
