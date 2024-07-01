import theme from "tailwindcss/defaultTheme";
import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./app/Livewire/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/views/filament/**/*.blade.php",
        "./resources/views/livewire/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./resources/views/home.blade.php",
    ],
    theme: {
        fontFamily: {
            sans: ["Helvetica", "Arial", "sans-serif"],
        },
        backgroundImage: {
            guardian: "url('/img/hero-bg.png')",
        },
        colors: {
            orange: {
                100: "#ffedd5",
                200: "#fed7aa",
                300: "#fdba74",
                400: "#fb923c",
                500: "#f97316",
                600: "#ea580c",
                700: "#c2410c",
                800: "#9a3412",
                900: "#7c2d12",
            },
        },
    },
};
