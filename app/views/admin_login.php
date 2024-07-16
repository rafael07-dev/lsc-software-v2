<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="flex flex-col h-screen bg-gray-200">

    <main class="flex-grow flex">

        <div class="container flex justify-center">
            <div class="bg-white shadow-lg rounded-lg w-96 p-6 my-10">
                <div class="mb-4"><h2 class="text-2xl font-bold text-center">Iniciar sesión</h2></div>
                <div>
                    <?php if (isset($error)) : ?>
                        <p class="text-red-500"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <form action="index.php?page=admin_login&action=login" method="POST">
                        <div class="mb-4 my-10">
                            <label for="username" class="block text-gray-700">Usuario:</label>
                            <input type="text" class="form-input mt-1 block w-full" id="username" name="username" required placeholder="username">
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-gray-700">Password</label>
                            <input type="password" class="form-input mt-1 block w-full" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="flex items-center justify-between mt-30">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Iniciar sesión</button>

                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="index.php?page=admin_update_password">Actualizar Contraseña</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </main>

</body>

</html>