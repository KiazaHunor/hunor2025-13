<?php
session_start();


$belepes = ['valami' => 'titkos'];

if (isset($_POST['kuld'])) 
    {
            if (isset($_POST['nev'])) 
            {
                $nev = $_POST['nev'];
            } 
            else 
            {
                $nev = '';
            }
            if (isset($_POST['jelszo'])) 
            {
                $jelszo = $_POST['jelszo'];
            } 
            else 
            {
                $jelszo = '';
            }
            

    if (!empty($nev) && !empty($jelszo)) 
        {
            if (isset($belepes[$nev]) && $belepes[$nev] === $jelszo) 
                {
                        $_SESSION['valid'] = true;
                        $_SESSION['nev'] = $nev;
                        $_SESSION['message'] = "Sikeres bejelentkezés!";
                }       
            else 
                {
                        $_SESSION['error'] = "Helytelen felhasználónév vagy jelszó!";
                }
        } 
        else 
        {
                $_SESSION['error'] = "Minden mezőt ki kell tölteni!";
        }
}


if (isset($_POST['kilep'])) 
    {
    session_destroy();
    }


header("Location: sessiondolgozat.php");
exit();