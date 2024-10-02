function generatePDF() {
    const { jsPDF } = window.jspdf;

    // Crear un nuevo documento PDF
    const doc = new jsPDF();

    // Obtener el contenido de la página
    const content = document.querySelector('.container').innerHTML;

    // Agregar el contenido al PDF
    doc.html(content, {
        callback: function (doc) {
            doc.save('cotizacion.pdf');
        },
        x: 10,
        y: 10
    });
}
