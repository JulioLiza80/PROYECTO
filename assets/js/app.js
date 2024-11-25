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
    const closeModalButton = document.getElementById('close-modal');
    const modal = document.getElementById('loginmodal');
    
    // Open the modal when clicking the Login button
    openModalButton.addEventListener('click', function () {
        modal.classList.remove('hidden'); // Show the modal
    });
    
    // Close the modal when clicking the close button
    closeModalButton.addEventListener('click', function () {
        modal.classList.add('hidden'); // Hide the modal
    });
    
    // Close the modal when clicking outside of it
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });

    const toggleButton = document.getElementById('navbar-toggle');
    const navbar = document.getElementById('navbar');
    
    toggleButton.addEventListener('click', function () {
        navbar.classList.toggle('hidden');
    });

/* Abrir/Cerrar el modal de login */

});

/* CUSTOM CAROUSEL FUNCTIONALITY */

// Initialize variables for the custom carousel




/* Initialize Swiper for Logos Carousel */
const swiper = new Swiper('.swiper-container', {
    slidesPerView: 6,
    spaceBetween: 2,
    loop: true,
    // autoplay: {                      // añade animación automática
    //     delay: 2000,
    // },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

const campaignCarousel = new Swiper('#campaign-carousel', {
    slidesPerView: 1,   // Show one image at a time
    spaceBetween: 0,    // Space between slides
    loopAddBlankSlides: true,
    navigation: {
        nextEl: '#campaign-carousel .swiper-button-next',
        prevEl: '#campaign-carousel .swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination', // Add this element to your HTML for the dots
        clickable: true,
        renderBullet: function (index, className) {
            return (
                '<button class="' +
                className +
                ' dot w-8 h-3 rounded-full bg-gray-200 hover:bg-white transition-all duration-300 focus:outline-none"></button>'
            );
        },
    },
});

