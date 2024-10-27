$(document).ready(function () {
    $('.filtro-btn-certificado').click(function (e) { 
        e.preventDefault();

        $('.filtro-btn-certificado').removeClass('active');
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

    $('.filtro-btn-min').change(function (e) { 
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