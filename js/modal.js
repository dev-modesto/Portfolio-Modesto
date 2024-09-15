function abrirModal(botaoClick, classIdTabela, idDataPesquisa, urlCaminho, classClickTrue, classModal, idModal) {
    $(document).ready(function () {
        $(document).on('click', botaoClick, function (e) {
            e.preventDefault();
            var idPrincipal = $(this).closest(classIdTabela).data(idDataPesquisa);
            // console.log(idPrincipal);

            $.ajax({
                type: "POST",
                url: urlCaminho,
                data: {
                    [classClickTrue]: true,
                    idPrincipal: idPrincipal,
                },
                success: function (response) {
                    $(classModal).html(response);
                    $(idModal).modal('show');
                }
            });
        });
    });
}

function abrirModalEditarProjeto(botaoClick, classIdTabela, idDataPesquisa, urlCaminho, classClickTrue, classModal, idModal) {
    $(document).on('click', botaoClick, function (e) {
        e.preventDefault();
        var idPrincipal = $(this).closest(classIdTabela).data(idDataPesquisa);

        $.ajax({
            type: "POST",
            url: urlCaminho,
            data: {
                [classClickTrue]: true,
                idPrincipal: idPrincipal,
            },

            success: function (response) {
                $(classModal).html(response);
                $(idModal).modal('show');

                var idTecAnt = $('.tecnologias-editar').val();
                var array = idTecAnt ? idTecAnt.split(',').map(Number) : [];
                
                array.forEach(function(idTecnologia) {
                    $('.container-imagem-tecnologia.editar[data-id-tecnologia="' + idTecnologia + '"]').addClass('selected');
                });
                
                $('body').on('click', '.container-imagem-tecnologia.editar', function (e) {
                    e.preventDefault();

                    var idTecnologia = $(this).data('id-tecnologia');

                    if (array.includes(idTecnologia)) {
                        var index = array.indexOf(idTecnologia);
                        array.splice(index, 1);
                        $(this).removeClass('selected');

                    } else {
                        array.push(idTecnologia);
                        $(this).addClass('selected');
                    }

                    $('#tecnologias-editar').val(array.join(','));
                });
            }
        });
    });
}

abrirModal('.btn-excluir-formacao', 'tr', 'id-formacao', 'include/cModalExcluirFormacao.php', 'click-excluir-formacao', '.modalExcluir', '#modalExcluir');
abrirModal('.btn-editar-formacao', 'tr', 'id-formacao', 'include/cModalEditarFormacao.php', 'click-editar-formacao', '.modalEditarFormacao', '#modalEditarFormacao');

abrirModal('.btn-excluir-autor', 'tr', 'id-autor', 'include/cModalExcluirAutor.php', 'click-excluir-autor', '.modalExcluir', '#modalExcluir');
abrirModal('.btn-editar-autor', 'tr', 'id-autor', 'include/cModalEditarAutor.php', 'click-editar-autor', '.modalEditarAutor', '#modalEditarAutor');

abrirModalEditarProjeto('.btn-editar-projeto', 'tr', 'id-projeto', 'include/cModalEditarProjeto.php', 'click-editar-projeto', '.modalEditarProjeto', '#modalEditarProjeto');
abrirModal('.btn-excluir-projeto', 'tr', 'id-projeto', 'include/cModalExcluirProjeto.php', 'click-excluir-projeto', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-editar-area-formacao', 'tr', 'id-area-formacao', 'include/cModalEditarAreaFormacao.php', 'click-editar-area-formacao', '.modalEditarAreaFormacao', '#modalEditarAreaFormacao');
abrirModal('.btn-excluir-area-formacao', 'tr', 'id-area-formacao', 'include/cModalExcluirAreaFormacao.php', 'click-excluir-area-formacao', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-excluir-tecnologia', 'tr', 'id-tecnologia', 'include/cModalExcluirTecnologia.php', 'click-excluir-tecnologia', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-editar-imagem', 'tr', 'id-imagem', 'include/cModalEditarImagem.php', 'click-editar-imagem', '.modalEditarImagem', '#modalEditarImagem');

abrirModal('.btn-editar-tecnologia', 'tr', 'id-tecnologia', 'include/cModalEditarTecnologia.php', 'click-editar-tecnologia', '.modalEditarTecnologia', '#modalEditarTecnologia');