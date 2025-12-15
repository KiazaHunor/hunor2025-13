<?php
include("utils.php");
//phpinfo();

$targetDir = "kepek/";
$config["kepek"]["eredeti"]["dir"]=$targetDir."eredeti/";
$config["kepek"]["eredeti"]["width"]=0;
$config["kepek"]["eredeti"]["height"]=0;
$config["kepek"]["kicsi"]["dir"]=$targetDir."kicsi/";
$config["kepek"]["kicsi"]["width"]=100;
$config["kepek"]["kicsi"]["height"]=100;
$config["kepek"]["kozepes"]["dir"]=$targetDir."kozepes/";
$config["kepek"]["kozepes"]["width"]=600;
$config["kepek"]["kozepes"]["height"]=600;
$config["kepek"]["nagy"]=["dir"=>$targetDir."nagy/",
                           "width"=>1000,
                           "height"=>1000];

$targetFile = $targetDir . "eredeti/" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

var_dump($targetFile);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) 
        {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
        else
        {
            echo "File is not an image.";
            $uploadOk = 0;
        }
}



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) 
{
    //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} 
else 
{
    foreach($config["kepek"] as $egyMEret)
        {
            $targetFile=$_FILES["fileToUpload"]["tmp_name"];
            $meret=getimagesize($targetFile);
            if($egyMEret["width"]==0 && $egyMEret["height"]==0)
                {
                    $ujX=$meret[0];
                    $ujY=$meret[0];
                    $celKep=$egyMEret["dir"]. basename($_FILES["fileToUpload"]["name"]);
                }
            if($meret[0]>$meret[1])
            {
                $ujX=$egyMEret["width"];
                $ujY=round($egyMEret["width"]/$meret[0]*$meret[1]);
            }
            else
            {
                $ujX=$egyMEret["height"];
                $ujY=round($egyMEret["height"]/$meret[1]*$meret[0]);
            }
            $celKep=$egyMEret["dir"]. basename($_FILES["fileToUpload"]["name"]);
        }


  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) 
    {
        $meret = getimagesize($targetFile);
        //meretek elkeszitese
        //100*100
        if($meret[0]>$meret[1])
            {
                $ujX=100;
                $ujY=round(100/$meret[0]*$meret[1]);
            }
        else
            {
                $ujX=100;
                $ujY=round(100/$meret[1]*$meret[0]);
            }
        d($meret);
        d($ujX);
        d($ujY);
        
        $kicsi = imagecreatetruecolor($ujX, $ujY);
        $forras = imagecreatefromjpeg($targetFile);

        imagecopyresized($kicsi, $forras, 0, 0, 0, 0, $ujX, $ujY, $meret[0], $meret[1]);
        imagecopyresampled($kicsi, $forras, 0, 0, 0, 0, $ujX, $ujY, $meret[0], $meret[1]);

        imagejpeg($kicsi,$celKep)

               //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    }

    else
    {
        //echo "Sorry, there was an error uploading your file.";
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="KepFeltolt.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
</body>
</html>