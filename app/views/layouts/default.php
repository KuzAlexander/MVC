<?php use \RedBeanPHP\R;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> будет подставлятся динамически--> 
    <?=$this->getMeta()?>
</head>
<body>
    <h1>Шаблон DEFAULT</h1>
    <!-- Сюда будет подключаться вид -->
    <?=$content?> 
    <?php
        $logs = R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();

        debug( $logs->grep( 'SELECT' ) );
    ?>
</body>
</html>