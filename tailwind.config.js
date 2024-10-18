/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php", "./node_modules/flowbite/**/*.js"],
    theme: {
        extend: {
            screens: {
                xs: "330px",
                sm: "390px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                xxl: "1440px"
            },
            textShadow: {
                DEFAULT: '2px 2px 4px rgba(0, 0, 0, 0.5)',
                sm: '1px 1px 2px rgba(0, 0, 0, 0.5)',
                lg: '3px 3px 6px rgba(0, 0, 0, 0.5)',
            },
            colors: {
                primary: {
                    DEFAULT: '#000000',
                    light: '#4d4d4d',
                    dark: '#000000',
                },
                  secondary:{
                    DEFAULT: '#CD1416',
                    light: '#FF6666',
                    dark: '#8B0E0E',
                }
                // "primary": '#B1FE2E',
                // "primary-dark": '#B1FE2E',
                // "primary-light": '#B1FE2E',
                // "primary-superlight":"#B1FE2E",
                // "secondary": "#01337F",
                // "secondary-dark": "#01337F",
                // "secondary-light": "#205AB2",
                // "dark": "#071A2A",
                // "dark-medium": "#555555",
                // "dark-light": "#F5F5F5",
                // "hh-green": "#B1FE2E",
                // "hh-green-dark": "#81CB01",
            },
            backgroundImage: {
                'bglogin': "url('/img/bg-login.png')",
            },
            borderColor: {
                orange: '#FFA500',
            },
            fontFamily: {
                // sans: ['Arial', 'sans-serif'],
                TCCCUnityHeadline: ['TCCC-UnityHeadline', 'sans-serif']
            },
            fontWeight:{
                light: 300,
                regular: 400,
                bold: 700
            }
        },
        // borderColor: {
        //     "custom-border-color": "#FF5900",
        //     "focus-border-color": "#FF5900", // Define el color de borde enfocado personalizado aquí
        // },
        // ringColor: {
        //     "custom-ring-color": "#FF5900", // Define el color de anillo personalizado aquí
        // },

    },
    plugins: [
        require("flowbite/plugin"),
        function ({ addUtilities }) {
            const newUtilities = {
              '.text-shadow': {
                textShadow: '2px 2px 4px rgba(0, 0, 0, 0.5)',
              },
              '.text-shadow-sm': {
                textShadow: '1px 1px 2px rgba(0, 0, 0, 0.5)',
              },
              '.text-shadow-lg': {
                textShadow: '3px 3px 6px rgba(0, 0, 0, 0.5)',
              },
            };
            addUtilities(newUtilities);
          },
    ],
    // variants: {
    //     extend: {
    //         borderColor: ['focus'], // Habilita las clases de borde enfocado
    //     },
    // },

};
