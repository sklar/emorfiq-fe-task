<?php
$mode = 'development' // production|development
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frontend demo task</title>

    <?php if ($mode === 'development') { ?>
        <!-- in development -->
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/assets/js/index.js"></script>
    <?php } else { ?>
    <link rel="stylesheet" href="/dist/app.css"/>
        <script type="module" src="/dist/app.js"></script>
    <?php } ?>
</head>
<body>
    <div class="Container">
        <div class="ProductCardLayout">
            <?php for ($i = 0; $i < 20; $i++) { ?>
                <div class="ProductCardLayout-item">
                    <?php include 'templates/productCard.php' ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
