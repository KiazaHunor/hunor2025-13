<?php
/*
osztás
    min 2 szám hányadosa
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: balról jobbra osztás
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        legyen hiba!
    ha 0: hiba: nullával való osztás
    ha az első 0:return 0
    url:oszt/2/3[/4/5/6/7]
*/
include_once "szamKeres.php";
function oszt($szamok)
{
    $csakSzamok=szamKeres($szamok);
    if(sizeof($csakSzamok)<2)
    {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }
    $eredmeny=$csakSzamok[0];
    for($i=1;$i<sizeof($csakSzamok);$i++)
    {
        $eredmeny/=$csakSzamok[$i];
    }
    return $eredmeny;

}

?>