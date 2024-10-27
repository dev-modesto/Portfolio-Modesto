$(document).ready(function () {
    $('.filtro-btn-projeto').click(function (e) { 
        e.preventDefault(); 

        $('.filtro-btn-projeto').removeClass('active');
        $(this).addClass('active');

        const idCategoria = $(this).val();

        $.ajax({
            type: "POST",
            url: "filtrarProjetos.php",
            data: {
                'click-btn-filtro-projeto':true,
                'idCategoria':idCategoria
            },
            success: function (response) {
                $('.container-principal-todos-projetos').html(response);
                initAccordion();
            }
        });
    });
});