document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.querySelector('form');

    formulario.addEventListener('submit', (e) => {
        const usuario = document.querySelector('input[name="usuario"], input[name="nuevo_usuario"]').value;
        const password = document.querySelector('input[name="password"], input[name="nueva_password"]').value;

        // 1. Validar campos vacíos
        if (usuario.trim() === "" || password.trim() === "") {
            e.preventDefault(); // Detiene el envío del formulario
            alert("⚠️ Por favor, completa todos los campos.");
            return;
        }

        // 2. Validar longitud mínima (ejemplo: 4 caracteres)
        if (password.length < 4) {
            e.preventDefault();
            alert("⚠️ La contraseña debe tener al menos 4 caracteres.");
            return;
        }

        console.log("Validación exitosa, enviando datos...");
    });
});