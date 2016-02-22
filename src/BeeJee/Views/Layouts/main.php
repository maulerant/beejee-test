<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link href="/media/css/bootstrap.min.css" rel="stylesheet">
    <link href="/media/css/docs.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/media/js/bootstrap.min.js"></script>
</head>
<body>
<header class="navbar navbar-static-top bs-docs-nav">
    <div class="container">
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <?php if (isset($isAdmin) && $isAdmin): ?>
                        <a href="/index.php?q=admin/logout">Логаут</a>
                    <?php else: ?>
                        <a href="/index.php?q=admin/login">Логин</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</header>
<div class="container bs-docs-container">
    <div class="row">
        <?= $content ?>
    </div>
</div>

</body>
</html>