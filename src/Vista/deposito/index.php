<?php 

include '../estructura/cabecera.php';
 $bd = new BaseDatos();

 $datos = data_submitted();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Image</title>
</head>
<body>
  <h2>Upload Image</h2>
  <form action="./action.php" method="post" enctype="multipart/form-data">
    <label for="image">Choose image(s) to upload:</label>
    <input type="file" name="image[]" id="image" multiple>
    <br><br>
    <input type="submit" value="Upload Image" name="submit">
  </form>
</body>
</html>

