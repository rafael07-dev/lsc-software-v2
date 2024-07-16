<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-200">

    <!-- Begin page content -->
    <main class="my-10 mx-40">
        <div class="container mx-auto">
            <h3 id="titulo" class="font-bold">Panel administrador</h3>

            <a class="inline-block align-baseline font-bold bg-red-500 px-2 py-1 text-sm text-white rounded" href="index.php?page=admin_logout">Cerrar session</a>

            <a href="index.php?page=admin_add_word" class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 ml-2">Agregar</a>

            <table class="min-w-full bg-white border border-gray-300" aria-describedby="titulo">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-2 px-4 border border-b border-gray-300" scope="col">Id</th>
                        <th class="py-2 px-4 border border-b border-gray-300" scope="col">Palabra</th>
                        <th class="py-2 px-4 border border-b border-gray-300" scope="col">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data['words'] as $word) : ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border border-b border-gray-300"><?php echo $word['id'] ?></td>
                            <td class="py-2 px-4 border border-b border-gray-300"><?php echo $word['word'] ?></td>

                            <td class="py-2 px-4 border border-b border-gray-300">
                                <a class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600" href="index.php?page=admin_edit_word&id=<?php echo $word['id'] ?>">Editar</a>
                                <a onclick="openEliminaModal(<?php echo $word['id'] ?>)" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 ml-2" href="#" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?php echo $word['id'] ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full">
            <div class="flex justify-between items-center px-4 py-2 border-b">
                <div class="modal-header">
                    <h1 class="text-lg font-semibold" id="notificationModalLabel">Notificación</h1>
                    <button onclick="closeNotificationModal()" type="button" class="text-gray-500 hover:text-gray-700s" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4">
                    <?php if (isset($data['success'])) : ?>
                        <p><?php echo $data['success']; ?></p>
                    <?php endif; ?>
                    <?php if (isset($data['error'])) : ?>
                        <p><?php echo $data['error']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="px-4 py-2 bg-gray-100 flex justify-end">
                    <button onclick="closeNotificationModal()" type="button" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="eliminaModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full">
            <div class="flex justify-between items-center px-4 py-2 border-b">
                <h1 class="text-lg font-semibold" id="eliminaModalLabel">Aviso</h1>
                <button onclick="closeEliminaModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="p-4">
                <p>¿Desea eliminar este registro?</p>
            </div>
            <div class="px-4 py-2 bg-gray-100 flex justify-end space-x-2">
                <form id="form-elimina" method="post" class="flex space-x-2">
                    <input type="hidden" name="_method" value="delete">
                    <button type="button" onclick="closeModal('eliminaModal')" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Cerrar</button>
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        <?php if (isset($data['success']) || isset($data['error'])) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                const notificationModal = document.getElementById('notificationModal');
                notificationModal.classList.remove('hidden');
            });
        <?php endif; ?>

        function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
    }

        function closeNotificationModal() {
            const notificationModal = document.getElementById('notificationModal');
            notificationModal.classList.add('hidden');
        }

        function openEliminaModal(id) {
            const modal = document.getElementById('eliminaModal');
            modal.classList.remove('hidden');
            const form = modal.querySelector('#form-elimina');
            form.action = 'index.php?page=delete_word&id=' + id;
        }

        function closeEliminaModal() {
            const modal = document.getElementById('eliminaModal');
            modal.classList.add('hidden');
        }
    </script>

</body>

</html>