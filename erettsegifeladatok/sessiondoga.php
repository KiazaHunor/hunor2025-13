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
exit(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container mt-4 p-4 bg-light">
        <H1>Lépjél be</H1>
        <form action="sessiondolgozat.php" method="post">
                <label for="nev">Felhasználónév:</label>
                <input type="text" id="nev" name="nev" class="form-control mb-2" required>

                <label for="jelszo">Jelszó:</label>
                <input type="password" id="jelszo" name="jelszo" class="form-control mb-3" required>

                <input type="submit" name="kuld" value="Küldés" class="btn btn-primary">
            </form>
        
            <p> <?= htmlspecialchars($_SESSION['nev']) ?>!</p>
            <form action="sessiondolgozat.php" method="post">
                <input type="submit" name="kilep" value="Kilépés" class="btn btn-primary">
            </form>
        
    </div>
    
</body>
</html>