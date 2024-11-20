module.exports = {
    content: [
        './templates/**/*.twig', // All Twig templates
        './assets/**/*.js',      // Any JavaScript files in assets
    ],
    theme: {
        extend: {
            colors: {
                novapurple: '#712282',
                novagreen: '#D2D813',
            },
        },

    },
    plugins: [
    ],
};
