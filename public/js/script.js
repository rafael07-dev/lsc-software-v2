const menuBar = document.querySelector('.menu-bar button');
const dropdownMenu = document.querySelector('.dropdown-menu');
const btnClose = document.querySelector('.btn-close');
const cards = document.querySelectorAll('.card-precios');
const cardTestimonial = document.querySelectorAll('.card-testimonial');
const numero = document.querySelectorAll('.numero');
const calendar = document.querySelectorAll('.calendario');
const windowHeight = window.innerHeight / 5 * 4;

//opciones calendario dinamico index
const enlaces = document.querySelectorAll('.enlace-categoria');

enlaces.forEach(enlace => {

    enlace.addEventListener('click', (e) => {
        e.preventDefault();

        const categoria = enlace.getAttribute('href').substring(1);
        console.log(categoria);

        const eventos = document.querySelectorAll('.wrapper-eventos');
    
        eventos.forEach(evento => {
            if (evento.id == categoria) {
                evento.classList.add('mostrar');
            }else{
                evento.classList.remove('mostrar');
            }
        })
    })
    
});

hideFirstElement();

function hideFirstElement() {
    const eventos = document.querySelectorAll('.wrapper-eventos');

    for (let index = 0; index < eventos.length; index++) {
        const element = eventos[index];
        element.classList.add('mostrar');
        break;
    }
}

window.addEventListener('scroll', animationScroll);

btnClose.addEventListener('click', () => {
    if (dropdownMenu.classList.contains('open')) {
        dropdownMenu.classList.remove('open');
    }
});

function showIfVisible(elements) {
    elements.forEach((element) => {
        const distanceFromTo = element.getBoundingClientRect().top;

        if (distanceFromTo < windowHeight + 50) {

            if(!element.classList.contains('show')){
                element.classList.toggle('show');
            }
        }else{
            element.classList.remove('show')
        }
    });
}

function animationScroll() {
    showIfVisible(cards);
    showIfVisible(numero);
    showIfVisible(cardTestimonial);
    showIfVisible(calendar);
}