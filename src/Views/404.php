<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404</title>
</head>
<body>
    <h1>404 not found</h1>

    <?php if (isset($msg) && strlen($msg) > 0) echo "<h2>$msg</h2>"; ?>
    Route: <?= $_SERVER['REQUEST_URI'] ?> not found

</body>
</html>