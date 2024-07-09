document.addEventListener('DOMContentLoaded', function () {
    const letterLinks = document.querySelectorAll('.letter-link');

    letterLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            const letterId = this.getAttribute('data-letter-id');


            fetch(`ajax/getWord.php?letter_id=${letterId}`)
            .then(response => response.text())
            .then(html => {
                const wordPanel = document.getElementById('word-panel');

                if(wordPanel){
                    wordPanel.innerHTML = html;
                }else{
                    console.error('elemento no encontrado');
                }
            })
            .catch(error => console.error('Error al cargar letter:', error));
        })
    })
})