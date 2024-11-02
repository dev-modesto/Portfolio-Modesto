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
                animaScroll();
                window.addEventListener('scroll', animaScroll);
            }
        });
    });
});

$(document).ready(function () {
    $('.filtro-btn-projetos-mobile').click(function (e) { 
        e.preventDefault(); 

        const idCategoria = $(this).val();
        const nomeCategoria = $(this).text();

        $('.filtro-btn-projetos-mobile').removeClass('ativo');
        $(this).addClass('ativo');
        
        $('.btn-cabecalho-select').html(nomeCategoria + '<span class="material-symbols-rounded ico-icodown-projetos">keyboard_arrow_down</span>');

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
                animaScroll();
                window.addEventListener('scroll', animaScroll);

                $('.container-select-conteudo').removeClass('ativo');
                $('.btn-cabecalho-select').removeClass('ativo');
            }
        });
    });
});

$('.btn-cabecalho-select').click(function (e) { 
    e.preventDefault();
    $('.container-select-conteudo').toggleClass('ativo');
    $(this).toggleClass('ativo');

    verificaSeAtivo();
    
});

function verificaSeAtivo() {
    const menuAtivo = document.querySelector('.container-select-conteudo');

    if (menuAtivo.classList.contains('ativo')) {
        fecharFiltroClick();
        fecharFiltroScroll();
    } 
}

function fecharFiltroClick() {
    $(document).off('click.fecharFiltroClick');

    $(document).on('click.fecharFiltroClick', function (e) {
        const target = $(e.target);
        if (!target.closest('.container-select-cabecalho').length) {
            $('.container-select-conteudo').removeClass('ativo');
            $('.btn-cabecalho-select').removeClass('ativo');
            $(document).off('click.fecharFiltroClick');
        }
    });
}

function fecharFiltroScroll() {
    $(document).off('scroll.fecharFiltroScroll');

    $(document).on('scroll.fecharFiltroScroll', function () {
        $('.container-select-conteudo').removeClass('ativo');
        $('.btn-cabecalho-select').removeClass('ativo');
        $(document).off('scroll.fecharFiltroScroll'); 
    });
}