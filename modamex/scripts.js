$(document).ready(function() {
    console.log("El script se está ejecutando");

    // Abrir y cerrar el aside con los filtros
    $('#open_filters_btn').click(function() {
        $('#filtersAside').toggleClass('active');
    });

    // Aplicar filtros
    $('#applyFiltersBtn').click(function() {
        var categoria = $('#categoria').val();
        var color = $('#color').val();
        var disenador = $('#disenador').val();
        var precio_min = $('#precioMin').val();
        var precio_max = $('#precioMax').val();

        // Enviar los filtros seleccionados al archivo PHP mediante AJAX
        $.ajax({
            url: 'filtrar.php', // El archivo PHP que hará la consulta
            method: 'GET',
            data: {
                categoria: categoria,
                color: color,
                disenador: disenador,
                precio_min: precio_min,
                precio_max: precio_max
            },
            success: function(response) {
                // Mostrar los productos en el contenedor
                $('#productsContainer').html(response);
            }
        });
    });
});
