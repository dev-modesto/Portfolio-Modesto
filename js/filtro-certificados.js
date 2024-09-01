$(document).ready(function () {
    $('.filtro-certificados-button').click(function (e) { 
        e.preventDefault();

        $('.filtro-certificados-button').removeClass('active');
        $(this).addClass('active');

        let idFiltro = $(this).val();
        $.ajax({
            type: "POST",
            url: "filtrarCertificados.php",
            data: {
                'click-btn-filtrar': true,
                'idFiltro': idFiltro
            },
            success: function (response) {
                $('.certificados-cards').html(response);
            }
        });
    });

    $('.filtro-certificados-button-min').change(function (e) { 
        e.preventDefault();

        let idFiltro = $(this).val();
        $.ajax({
            type: "POST",
            url: "filtrarCertificados.php",
            data: {
                'click-btn-filtrar': true,
                'idFiltro': idFiltro
            },
            success: function (response) {
                $('.certificados-cards').html(response);
            }
        });
    });
});