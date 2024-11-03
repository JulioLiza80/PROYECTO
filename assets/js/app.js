import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');


/* HEADER FUNCTIONS */

/* Alternar la visibilidad del menú de navegación para pantallas de menor resolución */
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('navbar-toggle');
    const navbar = document.getElementById('navbar');
    
    toggleButton.addEventListener('click', function () {
        navbar.classList.toggle('hidden');
    });

/* Abrir/Cerrar el modal de login */

    const openModalButton = document.getElementById('open-modal');
    const closeModalButton = document.getElementById('close-modal');
    const modal = document.getElementById('loginmodal');

    openModalButton.addEventListener('click', function () {
        modal.classList.remove('hidden'); // Show the modal
    });

    closeModalButton.addEventListener('click', function () {
        modal.classList.add('hidden'); // Hide the modal
    });

    /* Cierra el modal al hacer click fuera de él */
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});