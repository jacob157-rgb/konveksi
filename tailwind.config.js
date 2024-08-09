/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "selector",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        fontFamily: {
            sans: ["Poppins", "sans-serif"],
        },
        extend: {},
    },
    plugins: [require('@tailwindcss/forms'),require("preline/plugin")],
};
