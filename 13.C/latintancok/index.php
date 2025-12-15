<?php
header("Content-Type: application/json");
session_start();
if($_SERVER["REQUEST_METHOD"]== "POST")
{
    if(!isset($_SESSION["adatok"]))
    {
        $beolvas = file("tancrend.txt");
        $adatok = [];
        $sor = [];
        foreach($beolvas as $sorok) 
        {
            $sor[] = trim($sorok);
            if(count($sor) == 3) 
            {
                $adatok[] = 
                [
                    "tanc"=>$sor[0], 
                    "lany"=>$sor[1], 
                    "fiu"=>$sor[2]
                ];
                $sor = [];
            }
        }
        $_SESSION["adatok"] = $adatok;
    }

    $adatok = $_SESSION["adatok"];
    $data = json_decode(file_get_contents("php://input"), true);
    $feladat = $data["feladat"] ?? "";

    $response=[];

    if($feladat =="1")
        {
        echo json_encode([
                "kiir" => "TESZT OK",
                "adatok" => $adatok
            ]);
        }
    elseif($feladat=="2") //response-ba visszaadja
        {
        $elso = $adatok[0]["tanc"]; 
        $utso = $adatok[count($adatok)-1]["tanc"]; 
        echo json_encode(["elso"=>$elso, "utso"=>$utso]); 
    }








    
echo json_encode(["kiir" => "Semmi POST"]);
    exit;  
}



?>
