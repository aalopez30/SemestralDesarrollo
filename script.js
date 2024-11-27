function agregarAlCarrito(producto, precio, imagen) {
    fetch('carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'agregar',
            producto: producto,
            precio: precio,
            imagen: imagen
        })
    })
    .then(response => response.json())
    .then(data => {
        actualizarNumeroCarrito();
    })
    .catch(error => console.error('Error al agregar al carrito:', error));
}

function eliminarDelCarrito(index) {
    fetch('carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'eliminar',
            index: index
        })
    })
    .then(response => response.json())
    .then(data => {
        actualizarCarrito();
    })
    .catch(error => console.error('Error al eliminar del carrito:', error));
}

function actualizarNumeroCarrito() {
    fetch('carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'listar'
        })
    })
    .then(response => response.json())
    .then(data => {
        const numeroCarrito = document.getElementById('numero-carrito');
        numeroCarrito.textContent = data.carrito.length;
    })
    .catch(error => console.error('Error al actualizar el número del carrito:', error));
}

document.addEventListener('DOMContentLoaded', actualizarNumeroCarrito);

const botonIzquierdo = document.querySelector(".boton-carrusel.izquierdo");
const botonDerecho = document.querySelector(".boton-carrusel.derecho");

botonIzquierdo.addEventListener("click", (event) => {
    event.preventDefault();
    indiceActivo = (indiceActivo - 1 + productos.length) % productos.length;
    mostrarProducto(indiceActivo);
    reiniciarCambioAutomatico(); // Reinicia el contador cuando se cambia manualmente
});

botonDerecho.addEventListener("click", (event) => {
    event.preventDefault();
    indiceActivo = (indiceActivo + 1) % productos.length;
    mostrarProducto(indiceActivo);
    reiniciarCambioAutomatico(); // Reinicia el contador cuando se cambia manualmente
});

// Mostrar el primer producto al cargar la página
mostrarProducto(indiceActivo);

// Cambio automático cada 5 segundos
let intervalo;
function iniciarCambioAutomatico() {
    intervalo = setInterval(() => {
        indiceActivo = (indiceActivo + 1) % productos.length;
        mostrarProducto(indiceActivo);
    }, 5000); // Cambia cada 5 segundos
}

// Detener el cambio automático cuando el usuario interactúa
function reiniciarCambioAutomatico() {
    clearInterval(intervalo);
    iniciarCambioAutomatico();
}

iniciarCambioAutomatico(); // Inicia el cambio automático desde el principio