$(document).ready(function () {
    $('#formRegistro').on('submit', function (e) {
        e.preventDefault();

        var usuario = $('#usuario').val();
        var password = $('#password').val();

        $.ajax({
            type: 'POST',
            url: 'registro.php',
            data: { usuario: usuario, password: password },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    // Registro exitoso, redirigir al usuario a la pantalla de login
                    window.location.href = 'index.php'; // Reemplaza 'index.html' con la ruta de tu página de login
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function (xhr, status, error) {
                // Mostrar mensaje de error genérico
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al procesar tu solicitud. Por favor, inténtalo de nuevo más tarde.'
                });
                console.error(xhr.responseText);
            }
        });
    });
});
