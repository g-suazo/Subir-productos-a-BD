<?php
require 'conexion.php';
if(isset($_POST["submit"])){
  $Codigo = $_POST["Codigo"];
  $Nombre = $_POST['Nombre'];
  $Detalle = $_POST['Detalle'];
  $Precio = $_POST['Precio'];
  if($_FILES["Imagen"]["error"] === 4){
    echo 
    "<script> alert ('Imagen no existe');</script>";
  }
  else {
    $fileName = $_FILES["Imagen"]["name"];
    $fileSize = $_FILES["Imagen"]["size"];
    $tmpName = $_FILES["Imagen"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if(!in_array($imageExtension, $validImageExtension)){
      echo 
      "<script> alert ('Imagen invalida');</script>";
    } else if($fileSize > 1000000){
      echo 
      "<script> alert ('Tamano de la imagen muy larga');</script>";
    } else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/'. $newImageName);
      
      $query = "INSERT INTO productos VALUES ('$Codigo','$Nombre','$Detalle','$Precio','$newImageName')";
      mysqli_query($conexion, $query);
      echo
      "<script> alert ('Articulo subido');
      document.location.href = 'data.php';
      </script>";
    }

  }

}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda insertar productos </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>

  <body>

    <center><br><br><br>
      <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
          <h1 class="h3"background-color="red">Subir Datos</h1><br>
          <label for="Codigo">Codigo:</label>
          <input type="number" REQUIRED name ="Codigo" placeholder = "Insertar codigo" value=""/>
          <br><br>
          <label for="Nombre">Nombre:</label>
          <input type="text" REQUIRED name ="Nombre" placeholder = "Insertar Nombre" value=""/><br><br>
          <label for="Detalle">Detalle:</label>
          <input type="text" REQUIRED name ="Detalle" placeholder = "Insertar Detalle" value=""/><br><br>
          <label for="Precio">Precio:</label>
          <input type="text" REQUIRED name ="Precio" placeholder = "Insertar Precio" value=""/><br><br>
          <label for="Imagen">Imagen:</label>
          <input type="file" REQUIRED name ="Imagen" accept=".jpg, .jpeg, .png" value=""/><br><br>
          <button type = "submit" name ="submit" value =""> Subir</button>
      </form> <br><br>
      <a href="data.php">Data</a>

    </center>

  </body>