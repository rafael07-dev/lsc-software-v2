<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lSC SOFTWARE</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-200">

    <!-- Begin page content -->
    <main class="my-10 mx-40">
        <div class="container mx-auto">
            <h3 id="titulo" class="font-bold">Panel administrador</h3>

            <a class="inline-block align-baseline font-bold bg-red-500 px-2 py-1 text-sm text-white rounded" href="index.php?page=admin_logout">Cerrar session</a>

            <button onclick="openAgregaModal()" class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 ml-2">Agregar</button>

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
                                <a onclick="openEditModal(<?php echo $word['id'] ?>, '<?php echo $word['word'] ?>', <?php echo $word['letter_id'] ?>)" href="#" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600">Editar</a>
                                <a onclick="openEliminaModal(<?php echo $word['id'] ?>)" class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600 ml-2" href="#" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?php echo $word['id'] ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- modal notificacion-->

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

    <!-- modal eliminar registro-->

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

    <!-- modal agregar registro-->

    <div id="agregaModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full">
            <div class="flex justify-between items-center px-4 py-2 border-b">
                <h1 class="text-lg font-semibold" id="eliminaModalLabel">Agregar nueva palabra</h1>
                <button onclick="closeAgregaModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <div class="px-4 py-2 bg-gray-100 flex justify-end space-x-2">
                <form id="form-agrega" method="post" class="flex space-x-2">

                    <div class="col-md-4">
                        <label for="letter">Letra:</label>
                        <select id="letter" name="letter_id" required>
                            <?php foreach ($data['letters'] as $letter) : ?>
                                <option value="<?php echo $letter['id']; ?>"><?php echo $letter['letter']; ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                    </div>

                    <div class="col-md-8">
                        <label for="nombre" class="form-label">Palabra</label>
                        <input type="text" class="form-control" id="word" name="word" required>
                    </div>

                    <div class="flex items-center space-x-1">
                        <button type="button" onclick="closeModal('agregaModal')" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Cerrar</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal editar registro-->

    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-md w-full">
            <div class="flex justify-between items-center px-4 py-2 border-b">
                <h1 class="text-lg font-semibold" id="eliminaModalLabel">Editar palabra</h1>
                <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>

            <div class="px-4 py-2 bg-gray-100 flex justify-end space-x-2">
                <form id="form-edit" method="post" class="flex space-x-2">
                    <input type="hidden" name="word_id" value="" id="word_id">
                    <div>
                        <label for="letter">Letra:</label>
                        <select id="selec_letter" name="letter_id" required>
                            <?php foreach ($data['letters'] as $letter) : ?>
                                <option value="<?php echo $letter['id']; ?>" > <?php echo $letter['letter']; ?></option>
                            <?php endforeach; ?>
                        </select><br><br>
                    </div>

                    <div>
                        <label for="word" class="form-label">Palabra</label>
                        <input type="text" class="form-control" value="" id="input_word" name="word">
                    </div>

                    <div class="flex items-center space-x-1">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Cerrar</button>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
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

        function openAgregaModal() {
            const modal = document.getElementById('agregaModal');
            modal.classList.remove('hidden');
            const form = modal.querySelector('#form-agrega');
            form.action = 'index.php?page=create_word';
        }

        function openEditModal(id, word, letter) {
            const modal = document.getElementById('editModal');
            const inputWord = document.getElementById('input_word');
            const inputLetter = document.getElementById('selec_letter');
            const inputWordId = document.getElementById('word_id');

            if (modal && inputWord && inputLetter && inputWordId) {

                inputWord.value = word;
                inputLetter.value = letter;
                inputWordId.value = id;

                modal.classList.remove('hidden');

                const form = modal.querySelector('#form-edit');
                if (form) {
                    form.action = 'index.php?page=update_word';
                }
            } else {
                console.error('Uno o más elementos no fueron encontrados en el DOM.');
            }

        }

        function getParamsWord() {

        }

        function closeEliminaModal() {
            const modal = document.getElementById('eliminaModal');
            modal.classList.add('hidden');
        }

        function closeAgregaModal() {
            const modal = document.getElementById('agregaModal');
            modal.classList.add('hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }
    </script>

</body>

</html>