<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Contraseña</title>
</head>
<body>
    <h2>Actualizar Contraseña</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="index.php?page=admin_update_password&action=update" method="POST">
        <label for="current_password">Contraseña Actual:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>
        <label for="new_password">Nueva Contraseña:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Confirmar Nueva Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <button type="submit">Actualizar Contraseña</button>
    </form>
</body>
</html>

