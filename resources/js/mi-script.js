$(document).ready(function() {
    $('#study_name').on('keyup', function() {
        let query = $(this).val();
        if (query != '') {
            $.ajax({
                url: "/estudios", // Ruta de tu controlador de búsqueda
                type: "GET",
                data: {'study': query},
                success: function(data) {
                    $('#suggestion-box').html(data);
                    
                }
            })
        }
    });

    $(document).on('click', 'li', function() {
        let study = $(this).text();
        let price = $(this).data('price'); // Suponiendo que cada <li> tiene un atributo 'data-price'

        // Agrega el estudio a la tabla
        $('#studies-table').append('<tr><td>' + study + '</td><td>' + price + '</td></tr>');

        // Limpia el cuadro de sugerencias
        $('#suggestion-box').html('');
        $('#study_name').val('');
    });
});