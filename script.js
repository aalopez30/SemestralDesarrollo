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

function actualizarCarrito() {
    fetch('carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            accion: 'listar'
        })
    })
    .then(response => response.json())
    .then(data => {
        const listaCarrito = document.getElementById('lista-carrito');
        const totalCarrito = document.getElementById('total-carrito');
        let total = 0;

        listaCarrito.innerHTML = ''; // Limpiar la lista antes de actualizar
        data.carrito.forEach((item, index) => {
            // Crear el elemento de la lista
            const li = document.createElement('li');

            // Crear y agregar la imagen
            const img = document.createElement('img');
            img.src = item.imagen;
            img.alt = item.producto;
            img.style.maxWidth = '50px';
            img.style.marginRight = '10px'; // Espacio entre la imagen y el texto
            li.appendChild(img);

            // Crear y agregar el texto del producto
            const texto = document.createTextNode(`${item.producto} - $${parseFloat(item.precio).toFixed(2)}`);
            li.appendChild(texto);

            // Crear y agregar el botón para eliminar
            const button = document.createElement('button');
            button.textContent = 'Eliminar';
            button.style.marginLeft = '10px'; // Espacio entre el texto y el botón
            button.onclick = () => eliminarDelCarrito(index);
            li.appendChild(button);

            // Agregar el elemento completo a la lista
            listaCarrito.appendChild(li);

            // Sumar el precio al total
            total += parseFloat(item.precio);
        });

        // Actualizar el total en el DOM
        totalCarrito.textContent = total.toFixed(2);
    })
    .catch(error => console.error('Error al actualizar el carrito:', error));
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

// Solo actualizar el carrito completo si estamos en la página del carrito
if (document.getElementById('lista-carrito')) {
    document.addEventListener('DOMContentLoaded', actualizarCarrito);
}