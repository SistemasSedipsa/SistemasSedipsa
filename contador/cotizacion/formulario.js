document.getElementById('cliente').addEventListener('change', function () {
    const clienteId = this.value;

    if (clienteId) {
        // Realiza una solicitud AJAX para obtener los datos del cliente
        fetch(`obtener_cliente.php?id=${clienteId}`)
            .then(response => response.json())
            .then(data => {
                // Actualiza los elementos de la lista con los datos del cliente
                document.getElementById('cliente-empresa').textContent = data.empresa;
                document.getElementById('cliente-atiende').textContent = data.atiende;
                document.getElementById('cliente-puesto').textContent = data.puesto;
                document.getElementById('cliente-correo').textContent = data.correo;
                document.getElementById('cliente-telefono').textContent = data.telefono;

                // Muestra la información del cliente
                document.getElementById('informacion-cliente').style.display = 'block';
            })
            .catch(error => {
                console.error('Error al obtener los datos del cliente:', error);
            });
    } else {
        // Oculta la información si no hay cliente seleccionado
        document.getElementById('informacion-cliente').style.display = 'none';
    }
});

// Manejar la selección de descripciones
document.getElementById('descripcion').addEventListener('change', function () {
    const idPrueba = this.value;
    if (idPrueba) {
        // Hacer la solicitud AJAX para obtener la información de la prueba (descripcion, unidad, precio)
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'obtener_prueba.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parsear la respuesta JSON
                const prueba = JSON.parse(xhr.responseText);

                // Mostrar la tabla con la información de la prueba si está disponible
                if (prueba.descripcion) {
                    document.getElementById('prueba-descripcion').textContent = prueba.descripcion;
                    document.getElementById('prueba-unidad').textContent = prueba.unidad;
                    document.getElementById('prueba-precio').textContent = prueba.precio;
                }
            }
        };
        xhr.send(`id=${idPrueba}`);
    } else {
        // Ocultar la tabla si no hay prueba seleccionada
        document.getElementById('informacion-prueba').style.display = 'none';
    }
});

// Función para agregar una nueva fila con la descripción seleccionada
document.getElementById('agregar-descripcion').addEventListener('click', function () {
    const selectDescripcion = document.getElementById('descripcion');
    const idPrueba = selectDescripcion.value;

    // Obtener los valores de los campos de entrada
    const cantidadInput = document.getElementById('cantidad');
    const importeInput = document.getElementById('importe');
    const rendimientoInput = document.getElementById('rendimiento');

    const cantidad = parseFloat(cantidadInput.value);
    const importe = parseFloat(importeInput.value);
    const rendimiento = parseFloat(rendimientoInput.value);

    if (idPrueba && !isNaN(cantidad) && !isNaN(importe) && !isNaN(rendimiento)) {
        // Hacer la solicitud AJAX para obtener los datos de la prueba (descripcion, unidad, precio)
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'obtener_prueba.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Parsear la respuesta JSON
                const prueba = JSON.parse(xhr.responseText);

                // Crear una nueva fila con la descripción y los campos obtenidos de la prueba
                const nuevaFila = `
                    <tr>
                        <td>${document.querySelectorAll('#tabla-body tr').length + 1}</td> <!-- Número de partida -->
                        <td class="celda-descripcion">${prueba.descripcion}</td> <!-- Descripción -->
                        <td>${prueba.unidad}</td> <!-- Unidad -->
                        <td>${importe.toFixed(2)}</td> <!-- Valor Unitario -->
                        <td>${cantidad}</td> <!-- Cantidad -->
                        <td>${prueba.precio}</td> <!-- Importe -->
                        <td>${rendimiento}</td> <!-- Rendimiento -->
                        <td><button class="eliminar-fila">x</button></td> <!-- Botón de eliminar -->
                    </tr>
                `;

                // Insertar la nueva fila en la tabla
                document.getElementById('tabla-body').innerHTML += nuevaFila;

                // Resetear los campos de entrada
                selectDescripcion.value = "";
                cantidadInput.value = "";
                importeInput.value = "";
                rendimientoInput.value = "";
            }
        };
        xhr.send(`id=${idPrueba}`);
    } else {
        alert('Por favor complete todos los campos antes de agregar la descripción.');
    }
});

// Calcular el importe basado en la cantidad ingresada y el precio unitario
document.getElementById('tabla-body').addEventListener('input', function (e) {
    if (e.target.classList.contains('cantidad')) {
        const fila = e.target.closest('tr');
        const cantidad = parseFloat(e.target.value);
        const precioUnitario = parseFloat(fila.querySelector('td:nth-child(4)').textContent.replace('$', '').trim());

        // Calcular el importe
        if (!isNaN(cantidad) && !isNaN(precioUnitario)) {
            const importe = cantidad * precioUnitario;
            fila.querySelector('.importe').textContent = importe.toFixed(2);
        } else {
            fila.querySelector('.importe').textContent = '';
        }
    }
});

// Función para eliminar una fila
document.getElementById('tabla-body').addEventListener('click', function (e) {
    if (e.target.classList.contains('eliminar-fila')) {
        const fila = e.target.closest('tr');
        fila.remove(); // Eliminar la fila de la tabla
        // Opcional: Actualizar el número de partida en las filas restantes
        actualizarNumerosPartida();
    }
});

// Función para actualizar el número de partida
function actualizarNumerosPartida() {
    const filas = document.querySelectorAll('#tabla-body tr');
    filas.forEach((fila, index) => {
        fila.querySelector('td:first-child').textContent = index + 1; // Actualiza el número de partida
    });
}
