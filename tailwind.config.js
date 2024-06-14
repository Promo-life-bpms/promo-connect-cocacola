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
            colors: {
                "primary": '#B1FE2E',
                "primary-dark": '#B1FE2E',
                "primary-light": '#B1FE2E',
                "primary-superlight":"#B1FE2E",
                "secondary": "#01337F",
                "secondary-dark": "#01337F",
                "secondary-light": "#205AB2",
                "dark": "#071A2A",
                "dark-medium": "#555555",
                "dark-light": "#F5F5F5",
                "hh-green": "#B1FE2E",
                "hh-green-dark": "#81CB01",
            },
            backgroundImage: {
                'bglogin': "url('/img/bg-login.png')",
            },
            borderColor: {
                orange: '#FFA500',
            },
            fontFamily: {
                sans: ['Arial', 'sans-serif'],
            },
        },
        borderColor: {
            "custom-border-color": "#FF5900",
            "focus-border-color": "#FF5900", // Define el color de borde enfocado personalizado aquí
        },   
        ringColor: {
            "custom-ring-color": "#FF5900", // Define el color de anillo personalizado aquí
        },

    },
    plugins: [require("flowbite/plugin")],
    variants: {
        extend: {
            borderColor: ['focus'], // Habilita las clases de borde enfocado
        },
    },

};
