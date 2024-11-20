$(document).ready(function () {
    $('.filtro-btn-certificado').click(function (e) { 
        e.preventDefault();

        $('.filtro-btn-certificado').removeClass('active');
        $(this).addClass('active');

        let idFiltro = $(this).val();
        $.ajax({
            type: "POST",
            url: "include/filtros/filtrarCertificados.php",
            data: {
                'click-btn-filtrar': true,
                'idFiltro': idFiltro
            },
            success: function (response) {
                $('.certificados-cards').html(response);
            }
        });
    });

    $(document).ready(function () {
        $('.filtro-btn-certificados-mobile').click(function (e) { 
            e.preventDefault(); 

            const idFiltro = $(this).val();
            const nomeCategoria = $(this).text();

            $('.filtro-btn-certificados-mobile').removeClass('ativo');
            $(this).addClass('ativo');
            
            $('.btn-cabecalho-select').html(nomeCategoria + '<span class="material-symbols-rounded ico-icodown-projetos">keyboard_arrow_down</span>');

            $.ajax({
                type: "POST",
                url: "include/filtros/filtrarCertificados.php",
                data: {
                    'click-btn-filtrar': true,
                    'idFiltro': idFiltro
                },
                success: function (response) {
                    $('.certificados-cards').html(response);
                    $('.container-select-conteudo').removeClass('ativo');
                    $('.btn-cabecalho-select').removeClass('ativo');
                }
            });
        });
    });
});