import './bootstrap.js';
import Swiper from 'swiper/bundle';
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
    
    const openModalButton = document.getElementById('open-modal');
    const openModalButtonMobile = document.getElementById('open-modal-mobile');
    const closeModalButton = document.getElementById('close-modal');
    const modal = document.getElementById('loginmodal');
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    // Open the modal when clicking the Login button
    openModalButton.addEventListener('click', function () {
        modal.classList.remove('hidden'); // Show the modal
    });

    openModalButtonMobile.addEventListener('click', function () {
        modal.classList.remove('hidden'); // Show the modal
    });
    
    // Close the modal when clicking the close button
    closeModalButton.addEventListener('click', function () {
        modal.classList.add('hidden'); // Hide the modal
    });
    

/* Abrir/Cerrar el modal de login */

});

/* CUSTOM CAROUSEL FUNCTIONALITY */

// Initialize variables for the custom carousel




/* Initialize Swiper for Logos Carousel */
const swiper = new Swiper('.swiper-container', {
    slidesPerView: 2, // Default for smaller screens
    spaceBetween: 2,  // Default for smaller screens
    centeredSlides: true, // Center slides within the container
    loop: true,
    autoplay: {                      // añade animación automática
        delay: 1500,
    },
    breakpoints: {
        // Tailwind's sm breakpoint (>= 640px)
        640: {
            slidesPerView: 3,
            spaceBetween: 8,
        },
        // Tailwind's md breakpoint (>= 768px)
        768: {
            slidesPerView: 4,
            spaceBetween: 12,
        },
        // Tailwind's lg breakpoint (>= 1024px)
        1024: {
            slidesPerView: 5,
            spaceBetween: 16,
        },
        // Tailwind's xl breakpoint (>= 1280px)
        1280: {
            slidesPerView: 6,
            spaceBetween: 20,
        },
    },
});


