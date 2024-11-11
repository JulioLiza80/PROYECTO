module.exports = {
    content: [
        './templates/**/*.twig', // All Twig templates
        './assets/**/*.js',      // Any JavaScript files in assets
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
    ],
};
