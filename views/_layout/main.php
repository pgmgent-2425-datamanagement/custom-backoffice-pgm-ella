<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title ?? '') . ' ' . $_ENV['SITE_NAME'] ?></title>
    <link rel="stylesheet" href="/css/main.css?v=<?php if ($_ENV['DEV_MODE'] == "true") {
                                                        echo time();
                                                    }; ?>">
</head>

<body>
    <header>
        <div class="brand">Urban Flora</div>

        <nav>
            <a href="/">Home</a>
            <a href="#">item 2</a>
            <a href="#">item 3</a>
            <a href="#">item 4</a>
        </nav>
    </header>


    <main>
        <?= $content; ?>
    </main>

    <footer>
        &copy; <?= date('Y'); ?> - BrandName
    </footer>
</body>

</html>