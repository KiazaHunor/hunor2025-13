<?php
include "utils.php";

if (isset($_FILES["fileToUpload"]))
{
    $target_dir="";
    $config["kepek"]["kicsi"]["dir"] = $target_dir . "Kicsi/";
    $config["kepek"]["kicsi"]["width"] = 100;

    $config["kepek"]["nagy"]["dir"]=$target_dir ."Nagy/";
    $config["kepek"]["nagy"]["width"]=800;
    $config["kepek"]["nagy"]["height"]=600;
}





$target_dir = "kepek/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//w3  Complete Upload File PHP Script
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "Ez egy kép - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Ez a fájl nem egy kép.";
    $uploadOk = 0;
  }
}

if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ".basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


if ($_FILES["fileToUpload"]["size"] > 1000) {
  echo "Túl nagy a fájl.";
  $uploadOk = 0;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="fileToUpload" class="form-label">Válassz képet:</label>
        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control mb-3">
        <input type="submit" value="Feltöltés" name="submit" class="btn btn-primary">
    </form>
</body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</html>