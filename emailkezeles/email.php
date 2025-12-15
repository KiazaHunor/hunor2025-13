olyan oldal phpval ami emailcímeket gyüjt seccionban emailcímeknek kiirja a domain részét és kiirja mennyiből mennyi van

<?php
session_start();

if (!isset($_SESSION['emails'])) {
    $_SESSION['emails'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emails'][] = $email;
    }
}

$domainCounts = [];
foreach ($_SESSION['emails'] as $email) {
    $domain = substr(strrchr($email, "@"), 1);
    if (!isset($domainCounts[$domain])) {
        $domainCounts[$domain] = 0;
    }
    $domainCounts[$domain]++;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Domain Collector</title>
</head>
<body>
    <h1>Email Domain Collector</h1>
    <form method="POST" action="">
        <label for="email">Enter Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Submit</button>
    </form>

    <h2>Collected Domains</h2>
    <?php if (!empty($domainCounts)): ?>
        <ul>
            <?php foreach ($domainCounts as $domain => $count): ?>
                <li><?php echo htmlspecialchars($domain); ?>: <?php echo $count; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No emails collected yet.</p>
    <?php endif; ?>
</body>
</html>