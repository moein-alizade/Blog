module.exports = {
    // purge: {
    //     enabled: false,
    //     content: [
    //         './resources/views/**/*.blade.php',
    //     ]
    // },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            width: {
                '200': '50rem',
            },

            colors: {
                green: {
                    450: '#00ff7f',
                    850: '#2F4F4F',
                }
            },

        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
