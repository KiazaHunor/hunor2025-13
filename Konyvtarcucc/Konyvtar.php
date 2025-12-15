<?php

function randomNev()
{
    $keszlet="qwertzuiopasdfghjklmnbvcxy";
    //echo $keszlet[1];
    $betuDarab=rand(2,8);
    $szo="";
    for($i=0;$i<$betuDarab;$i++)
        {
            $betu=rand(0,strlen($keszlet)-1);
            //echo $betu." ";
            $szo =$szo.$keszlet[$betu];
        }
        return $szo;
}

$mennyi = rand(1,5);
$nevek=[];
for($i=0;$i<$mennyi;$i++)
{
    $nevek[] = randomNev();
}

function konyvtarLetrehoz($konyvtarNev)
{
    
}

randomNev();



// Desired directory structure
$structure = './depth1/depth2/depth3/';



// To create the nested structure, the $recursive parameter 
// to mkdir() must be specified.
/*
if (!mkdir($structure, 0777, true)) {
    die('Failed to create directories...');
}
*/
// ...
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>