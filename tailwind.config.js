module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                /* Green */
                "green-high": "#10DA48",
                "green-med": "#17AC42",
                "green-low": "#1F552D",
                "green-dark": "#25382A",
                "green-faded": "#7FCB94",
                /* Red */
                "red-high": "#FF0021",
                "red-med": "#941925",
                "red-low": "#5E2523",
                "red-dark": "#3E2627",
                "red-faded": "#FF4863",
                /* gray */
                "gray-high": "#555854",
                "gray-med": "#4A4B49",
                "gray-low": "#3E403E",
                "gray-dark": "#2B2D2A",
                /* black */
                "black-high": "#282E28",
                "black-med": "#292C28",
                "black-low": "#272A26",
                "black-dark": "#262825",
            },
            fontFamily: {
                "dmSans": ['DM-sans', 'sans-serif']
            },
            screens: {
                // => TABLET TO MOBILE
                'sm': '640px',
                // => @media (min-width: 640px) { ... }
                'md': '720px',
                // => @media (min-width: 768px) { ... }
                // => PC VIEW
                'lg': '1024px',
                // => @media (min-width: 1024px) { ... }
                'xl': '1280px',
                // => @media (min-width: 1280px) { ... }
                '2xl': '1536px',
                // => @media (min-width: 1536px) { ... }
              },
        },
    },
    plugins: [],
}