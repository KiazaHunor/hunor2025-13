<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szallít</title>
</head>
<body>
    <?php
    include_once("utils.php");
    function feladat2Form()
    {
        $vissza='<form action="'.$_SERVER["PHP_SELF"].'" method="get">';
        $vissza.='<label for="szallitasId"> Adja meg melyik adatsorra kíváncsi!</label>';
        $vissza.='<input type="number" id="szallitasId" name="szallitasId">';
        $vissza.='<input type="submit">';
        $vissza.='</form>';

        return $vissza;
    }

    function tav($szalagHossz, $indulashelye, $erkezeshelye)
    {
      if($erkezeshelye>$indulashelye)
        {
          return $erkezeshelye-$indulashelye;
        }
        else
        {
          $szalagHossz-$indulashelye+$erkezeshelye;
        }
    }

    $file = fopen("kep.txt", "r");
        
    
        $adatok = [];
        $sor=fgets($file);
        $darabok=explode(" ",$sor);
        $szalagHossz=$darabok[0];        
        $sebesseg=$darabok[1];

        while(! feof($file)) {
            $sor = fgets($file);
            if($sor!="")
            {
                $darabok=explode(" ",$sor);
                $adatok[]=$darabok;
            }
            
        }

        fclose($file);

        //d($adatok);
        echo feladat2Form();
        if(isset($_GET["szallitasId"])){
            if($_GET["szallitasId"]== ""){
                $szId=0;
            }
            else{
                $szId=$_GET["szallitasId"]-1;
            }
            
            //d($adatok[$_GET["szallitasId"]]);
            if(isset($adatok[$szId])){
                     echo    "<div>Honnan: <strong>".$adatok[$szId][1]."</strong>
                        Hova: <strong>".$adatok[$szId][2]."</strong>
                    </div>";
            }
            else{
                echo "<div>
                    Nincs <strong>".($szId+1)."</strong>
                    </div>";
            }
       
           
        }
        /*foreach($adatok as $elem)
          {
            echo tav($szalagHossz,$elem[1],$elem[2]) ."<br>\n";
          }*/
      $legnagyobb=-1;
      foreach($adatok as $elem)
        {
          if($legnagyobb < tav($szalagHossz,$elem[1],$elem[2]))
            {
                $legnagyobb = tav($szalagHossz,$elem[1],$elem[2]);
            }
          
        }
        echo "A legnagyobb távolság: $legnagyobb<br>";
        echo "A maximalis távolságú szállítások sorszáma: ";


        $tomb=[];
        foreach($adatok as $i => $elem)
        {
          if($legnagyobb == tav($szalagHossz,$elem[1],$elem[2]))
            {
              $tomb[]=$i;
              //echo $i.",";
            }
          
        }
        echo implode(",",$tomb);

        $ossz=0;
        foreach($adatok as $elem)
        {
          if($elem[1] > $elem[2])
            {
              $ossz += $elem[3];
            }
        }
        echo "<p> A kezdőpont előtt elhaladó rekeszek össztömege: $ossz";


        $indexTomb=[]
        foreach($adatok as $i => $elem)
        {
          if($idopomt>=$elem[0]
          && tav($szalagHossz,$elem[1],$elem[2])*$sebesseg+$elem[0] > $idopomt)
          {
            $indexTomb[]=$i+1;
          }
        }

        if(sizeoff($indexTomb)==0)
          {
            echo "<p> Nincs"
          }
        else
          {
            echo "<p> A szallitott rekeszek halmaza:".implode(",",$indexTomb)
          }

        $tomegek=[];
        for($i=0;$i<sizeof($adatok);$i++)
          {
            */
            //if(isset($tomegek[$adatok[$i][1]]))            {//$tomegek[$adatok[$i][1]]+=$adatok[$i][3];            }
            else
              {
                $tomegek[$adatok[$i][1]]=$adatok[$i][3];
              }
            $tomegek[$adatok[$i][1]]+=$adatok[$i][3];
          }
          $fp=fopen("kep.txt","w")
          foreach($tomegek as $K=> $elem)
            {
              fwrite($fp,$K." ".$elem)
            }

          fclose($fp);
    ?>
    
</body>
</html>