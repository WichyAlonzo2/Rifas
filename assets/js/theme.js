document.addEventListener("DOMContentLoaded", function() {
    const themeToggle = document.getElementById("themeToggle");
    const body = document.body;

    // Verifica el tema actual al cargar la página
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark");
        themeToggle.checked = true;
    } else {
        body.classList.add("light");
    }

    // Cambia el tema al hacer clic en el interruptor
    themeToggle.addEventListener("change", function() {
        if (themeToggle.checked) {
            body.classList.replace("light", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            body.classList.replace("dark", "light");
            localStorage.setItem("theme", "light");
        }
    });

    const themeTogglex = document.getElementById("themeToggle__");
    // Verifica el tema actual al cargar la página
    if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark");
        themeTogglex.checked = true;
    } else {
        body.classList.add("light");
    }

    // Cambia el tema al hacer clic en el interruptor
    themeTogglex.addEventListener("change", function() {
        if (themeTogglex.checked) {
            body.classList.replace("light", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            body.classList.replace("dark", "light");
            localStorage.setItem("theme", "light");
        }
    });
});