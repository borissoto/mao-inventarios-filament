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
    },
};
