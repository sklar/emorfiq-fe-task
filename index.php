<?php require __DIR__ . '/templates/vite.php'; ?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Frontend demo task</title>
    <?php vite_assets('assets/scss/index.scss'); ?>
</head>
<body>
    <div class="Container">
        <div class="ProductCardLayout">
            <?php for ($i = 0; $i < 20; $i++) { ?>
                <div class="ProductCardLayout-item">
                    <?php include __DIR__ . '/templates/productCard.php'; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
