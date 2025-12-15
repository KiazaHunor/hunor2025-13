<?php
/*
    min 2 szám összeadása
    csak 1 szám: hiba: min 2 szám kell
    ha sok szám: adja össze mind
    ha nem szám valamelyik,hanem szöveg: 
        pl:2/3/4/5/ert/4/6/ads/-12
        ami szám, azt adja össze, szövegeket hagyja ki
    url: osszead/2/3[/4/5/6/7]
*/
include_once "szamKeres.php";
function osszead($szamok)
{
    //osszead/1/2/3/4/qwe/12
    // ["osszead","1","qwe","12"]
    //ami kell: [1,12]
    $csakSzamok=szamKeres($szamok);
    if(sizeof($csakSzamok)<2)
    {
        return $GLOBALS["lang"]["Hiba: legalább két szám kell!"];
    }

    return array_sum($csakSzamok);
};
?>