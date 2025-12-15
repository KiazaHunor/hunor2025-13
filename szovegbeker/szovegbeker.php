php oldal 2 kulon urlap két kulon szovegbevitelre valo mezovel, az elsobe bekuldunk egy szoveget => sorszamozatlan lista, masodik  sorszamozott lista 
sestion adatok eltarolasa 
elem törlése 
<?php
session_start();

// Ha még nincs session tömb létrehozva
if (!isset($_SESSION['ul_items'])) {
    $_SESSION['ul_items'] = [];
}
if (!isset($_SESSION['ol_items'])) {
    $_SESSION['ol_items'] = [];
}

// Ha az első űrlapot küldik be
if (isset($_POST['ul_submit'])) {
    $text = trim($_POST['ul_text']);
    if ($text !== '') {
        $_SESSION['ul_items'][] = htmlspecialchars($text);
    }
}

// Ha a második űrlapot küldik be
if (isset($_POST['ol_submit'])) {
    $text = trim($_POST['ol_text']);
    if ($text !== '') {
        $_SESSION['ol_items'][] = htmlspecialchars($text);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Két lista sessionnel</title>
</head>
<body>
    <h1>Sorszámozatlan lista</h1>
    <form method="post">
        <input type="text" name="ul_text" placeholder="Írj ide szöveget">
        <button type="submit" name="ul_submit">Hozzáadás</button>
    </form>

    <ul>
        <?php foreach ($_SESSION['ul_items'] as $item): ?>
            <li><?= $item ?></li>
        <?php endforeach; ?>
    </ul>

    <h1>Sorszámozott lista</h1>
    <form method="post">
        <input type="text" name="ol_text" placeholder="Írj ide szöveget">
        <button type="submit" name="ol_submit">Hozzáadás</button>
    </form>

    <ol>
        <?php foreach ($_SESSION['ol_items'] as $item): ?>
            <li><?= $item ?></li>
        <?php endforeach; ?>
    </ol>
</body>
</html>