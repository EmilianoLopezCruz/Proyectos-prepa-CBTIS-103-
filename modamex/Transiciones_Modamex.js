// Seleccionar todos los "trasicion_link"
document.querySelectorAll(".trasicion_link").forEach((enlace) => 
{
    // Agregar evento de click a cada enlace
    enlace.addEventListener("click", function (e) 
    {
        e.preventDefault(); // Evitar el comportamiento predeterminado del enlace
        const destino = this.getAttribute("href"); // Obtener la URL destino
        const contenedor = document.querySelector(".contenedor_general"); // Seleccionar el contenedor principal

        // Agregar la clase para iniciar la animación de rotación
        contenedor.classList.add("rotado");

        // Redirigir inmediatamente después de aplicar la animación
        window.location.href = destino;
    });
});

// Agrega un evento click al "ojito"
document.getElementById("ojito").addEventListener("click", function () 
{
    // Obtiene el campo de entrada de contraseña
    const Contraseña = document.getElementById("password");
    const type = Contraseña.getAttribute("type") === "password" ? "text" : "password";
    Contraseña.setAttribute("type", type);

    // Cambiar el ícono del ojito
    this.innerHTML = type === "password" 
        ? "<img src='Imagenes/Se ve.png' alt='Mostrar contraseña' width='30'>" 
        : "<img src='Imagenes/No se ve.png' alt='Ocultar contraseña' width='31'>";
});