<!-- admin_edit_word.php -->

<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Palabra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3">Editar Palabra</h3>

            <?php if (isset($data['error'])) : ?>
                <p class="text-danger"><?php echo $data['error']; ?></p>
            <?php endif; ?>

            <form action="index.php?page=update_word" method="POST">
                <input type="hidden" name="word_id" value="<?php echo $data['word']['id']; ?>">
                <div class="mb-3">
                    <label for="word" class="form-label">Palabra</label>
                    <input type="text" class="form-control" id="word" name="word" value="<?php echo $data['word']['word']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="letter_id" class="form-label">Letra</label>
                    <select class="form-select" id="letter_id" name="letter_id" required>
                        <?php foreach ($data['letters'] as $letter) : ?>
                            <option value="<?php echo $letter['id']; ?>" <?php echo ($letter['id'] == $data['word']['letter_id']) ? 'selected' : ''; ?>><?php echo $letter['letter']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="index.php?page=admin" class="btn btn-secondary">Cancelar</a>
            </form>

        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div class="container">
            <span class="text-body-secondary">2024 | Códigos de Programación</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>