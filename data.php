<?php
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data</title>
</head>
<body>
  <table border=1 cellspacing="0" cellpadding="10">
    <tr>
      <td>Codigo</td>
      <td>Nombre</td>
      <td>Detalle</td>
      <td>Precio</td>
      <td>Imagen</td>
    </tr>
    
    <?php
    $i = 1;
    $rows = mysqli_query($conexion, "SELECT * FROM productos");
    ?>

    <?php foreach ($rows as $row) : ?>

    <tr>
      <td><?php echo $row["Codigo"]; ?></td>
      <td><?php echo $row["Nombre"]; ?></td>
      <td><?php echo $row["Detalle"]; ?></td>
      <td><?php echo $row["Precio"]; ?></td>
      <td><img src="img/<?php echo $row['Imagen']; ?> " width=200 title="<?php echo $row['Imagen']; ?>"> </td>
    </tr>
    <?php endforeach; ?>
</table>

<BR>
 <a href="../tienda/form.php">Upload Image File</a>
  
</body>
</html>