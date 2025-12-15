<?php
session_start();


$tesztfelhasznalo = "admin";
$tesztjelszo = "admin";


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (isset($_POST["felhasznalo"])) 
        {
            $felhasznalo = $_POST["felhasznalo"];
        } 
        else 
        {
            $felhasznalo = "";
        }

        if (isset($_POST["jelszo"]))
            {
                $jelszo = $_POST["jelszo"];
            }
        else
        {
            $jelszo ="";
        }

        if ($felhasznalo === $tesztfelhasznalo && $jelszo === $tesztjelszo) {
            $_SESSION["belepve"] = true;
            $_SESSION["felhasznalo"] = $felhasznalo;
        } 
        else 
        {
            $hiba = "Nemjó a jelszó vagy a felhasználónév!";
        }
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <meta name="viewport" content="width=device-width"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center">

<div class="card shadow-lg p-4" style="width: 350px;">
    <?php if (isset($_SESSION["belepve"]) && $_SESSION["belepve"]): ?>
        <h4 class="text-center mb-3">Üdv, <?php echo $_SESSION["felhasznalo"];?></h4>
        <p class="text-center ">Sikeresen bejelentkeztél.</p>
        <div class="text-center">
            <a href="?logout=1" class="btn btn-danger w-100 mt-3">Kilépés</a>
        </div>
    <?php else: ?>
        <h4 class="text-center mb-4">Bejelentkezés</h4>

        <?php if (!empty($hiba)): ?>
            <div class="alert alert-danger py-2" role="alert">
                <?php echo $hiba; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Felhasználónév</label>
                <input type="text" name="felhasznalo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jelszó</label>
                <input type="password" name="jelszo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Belépés</button>
        </form>

        <p class="text-muted text-center mt-3" style="font-size: 20px">
            Teszt: <b>admin</b> / <b>admin</b>
        </p>
    <?php endif; ?>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
