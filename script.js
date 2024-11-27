// Función central para realizar solicitudes al servidor
async function realizarFetch(accion, datos) {
    try {
        const response = await fetch('carrito.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ accion, ...datos })
        });
        return await response.json();
    } catch (error) {
        console.error(`Error al realizar la acción "${accion}":`, error);
        throw error; // Permite manejar el error en las funciones que llaman a esta
    }
}

// Función para agregar un producto al carrito
async function agregarAlCarrito(producto, precio, imagen) {
    if (!producto || !precio || !imagen) {
        console.error('Datos inválidos para agregar al carrito');
        return;
    }
    try {
        await realizarFetch('agregar', { producto, precio, imagen });
        actualizarNumeroCarrito();
    } catch (error) {
        alert('No se pudo agregar el producto al carrito. Intenta de nuevo más tarde.');
    }
}

// Función para eliminar un producto del carrito
async function eliminarDelCarrito(index) {
    try {
        await realizarFetch('eliminar', { index });
        actualizarCarrito();
    } catch (error) {
        alert('No se pudo eliminar el producto del carrito. Intenta de nuevo más tarde.');
    }
}

// Actualiza el número del carrito
async function actualizarNumeroCarrito() {
    try {
        const data = await realizarFetch('listar', {});
        const numeroCarrito = document.getElementById('numero-carrito');
        numeroCarrito.textContent = data.carrito.length;
    } catch (error) {
        console.error('Error al actualizar el número del carrito:', error);
    }
}

// Actualiza la lista visual del carrito
async function actualizarCarrito() {
    try {
        const data = await realizarFetch('listar', {});
        const carritoContainer = document.getElementById('lista-carrito');
        carritoContainer.innerHTML = ''; // Limpia el carrito
        data.carrito.forEach((item, index) => {
            carritoContainer.innerHTML += `
                <li>
                    <img src="${item.imagen}" alt="${item.producto}" width="50">
                    <p>${item.producto} - $${item.precio}</p>
                    <button onclick="eliminarDelCarrito(${index})">Eliminar</button>
                </li>
            `;
        });
        const totalCarrito = document.getElementById('total-carrito');
        totalCarrito.textContent = data.total.toFixed(2);
    } catch (error) {
        console.error('Error al actualizar el carrito visual:', error);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    actualizarNumeroCarrito();
    if (document.getElementById('lista-carrito')) {
        actualizarCarrito();
    }
});