document.addEventListener("DOMContentLoaded", function () {
    // Función para cargar las descripciones desde el archivo PHP
    function cargarDescripciones(callback) {
        fetch('datos_pruebas.php')
            .then(response => response.json())
            .then(data => {
                callback(data);
            })
            .catch(error => console.error('Error al cargar descripciones:', error));
    }

    // Función para mostrar las opciones de descripción en la celda
    function mostrarOpcionesDescripcion(celda) {
        document.querySelectorAll('.dropdown').forEach(dropdown => dropdown.remove());

        let dropdown = document.createElement('div');
        dropdown.classList.add('dropdown');
        dropdown.style.left = `${celda.getBoundingClientRect().left}px`;
        dropdown.style.top = `${celda.getBoundingClientRect().bottom}px`;
        dropdown.style.width = `${celda.offsetWidth}px`;
        dropdown.style.display = 'block'; 

        cargarDescripciones(function (descripciones) {
            descripciones.forEach(descripcion => {
                let opcion = document.createElement('div');
                opcion.textContent = descripcion.descripcion;

                opcion.addEventListener('click', function () {
                    celda.textContent = descripcion.descripcion;
                    dropdown.remove();
                });

                dropdown.appendChild(opcion);
            });
        });

        document.body.appendChild(dropdown);

        function cerrarDropdown(event) {
            if (!dropdown.contains(event.target) && !celda.contains(event.target)) {
                dropdown.remove();
                document.removeEventListener('click', cerrarDropdown);
            }
        }

        document.addEventListener('click', cerrarDropdown);

        const cerrarInactividad = setTimeout(() => {
            dropdown.remove();
            document.removeEventListener('click', cerrarDropdown);
        }, 5000);

        dropdown.addEventListener('click', function () {
            clearTimeout(cerrarInactividad);
        });

        dropdown.addEventListener('animationend', () => {
            clearTimeout(cerrarInactividad);
        });
    }

    document.getElementById('agregar-fila').addEventListener('click', function () {
        var table = document.getElementById('tabla-examinacion').getElementsByTagName('tbody')[0];
        var newRow = table.insertRow();

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);
        var cell6 = newRow.insertCell(5);
        var cell7 = newRow.insertCell(6);

        cell1.innerHTML = table.rows.length;
        cell2.classList.add('celda-descripcion');
        cell2.innerHTML = 'Haz clic para elegir'; 
        cell3.setAttribute('contenteditable', 'true');
        cell4.setAttribute('contenteditable', 'true');
        cell5.setAttribute('contenteditable', 'true');
        cell6.setAttribute('contenteditable', 'true');
        cell7.setAttribute('contenteditable', 'true');

        cell2.addEventListener('click', function () {
            mostrarOpcionesDescripcion(cell2);
        });

        cell6.addEventListener('input', calcularTotales);
    });

    const tablaBody = document.getElementById('tabla-examinacion').getElementsByTagName('tbody')[0];

    function calcularTotales() {
        let subtotal = 0;
        const filas = tablaBody.getElementsByTagName('tr');

        for (let fila of filas) {
            const importeCelda = fila.cells[5]; 
            const valor = parseFloat(importeCelda.textContent) || 0;
            subtotal += valor;
        }

        // Actualiza el subtotal en la tabla
        const subtotalSpan = document.getElementById('subtotal-span');
        subtotalSpan.textContent = subtotal.toFixed(2);

        // Calcular el IVA (16%)
        const iva = subtotal * 0.16;
        const ivaSpan = document.getElementById('iva-span');
        ivaSpan.textContent = iva.toFixed(2);

        // Calcular el total
        const total = subtotal + iva;
        const totalSpan = document.getElementById('total-span');
        totalSpan.textContent = total.toFixed(2);
    }

    const celdasImporte = tablaBody.querySelectorAll('tr td:nth-child(6)');
    celdasImporte.forEach(celda => {
        celda.addEventListener('input', calcularTotales);
    });

    const celdasDescripcion = tablaBody.querySelectorAll('.celda-descripcion');
    celdasDescripcion.forEach(celda => {
        celda.addEventListener('click', function () {
            mostrarOpcionesDescripcion(celda);
        });
    });
});
