<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>
<body>

<?php include 'templates/header.php' ?>
<h1>Vista admin <?php echo $_SESSION['username'] ?></h1>

<a href="index.php?page=admin_logout&action=logout">Cerrar sesion</a>

    
</body>
</html>