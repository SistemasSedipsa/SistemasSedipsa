$(document).ready(function() {
    $('#formCambiarPassword').on('submit', function(e) {
        e.preventDefault();
        
        var usuario = $('#usuario').val();
        var nuevaPassword = $('#nuevaPassword').val();
        
        // Validación básica del formulario
        if(usuario.trim() == '' || nuevaPassword.trim() == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, completa todos los campos.'
            });
            return;
        }
        
        // Envío de datos mediante AJAX
        $.ajax({
            type: 'POST',
            url: 'cambiar_pass.php', // Archivo PHP que procesará la solicitud
            data: { usuario: usuario, nuevaPassword: nuevaPassword },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Contraseña cambiada exitosamente
                    Swal.fire({
                        icon: 'success',
                        title: 'Contraseña Cambiada',
                        text: response.message
                    }).then(function() {
                        window.location.href = 'index.php'; // Redirigir a la página principal
                    });
                } else {
                    // Mostrar mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
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
