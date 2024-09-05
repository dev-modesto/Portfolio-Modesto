function abrirModal(botaoClick, classIdTabela, idDataPesquisa, urlCaminho, classClickTrue, classModal, idModal) {
    $(document).ready(function () {
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
                }
            });
        });
    });
}

abrirModal('.btn-excluir-formacao', 'tr', 'id-formacao', 'include/cModalExcluirFormacao.php', 'click-excluir-formacao', '.modalExcluir', '#modalExcluir');
abrirModal('.btn-editar-formacao', 'tr', 'id-formacao', 'include/cModalEditarFormacao.php', 'click-editar-formacao', '.modalEditarFormacao', '#modalEditarFormacao');

abrirModal('.btn-excluir-autor', 'tr', 'id-autor', 'include/cModalExcluirAutor.php', 'click-excluir-autor', '.modalExcluir', '#modalExcluir');
abrirModal('.btn-editar-autor', 'tr', 'id-autor', 'include/cModalEditarAutor.php', 'click-editar-autor', '.modalEditarAutor', '#modalEditarAutor');

abrirModal('.btn-editar-projeto', 'tr', 'id-projeto', 'include/cModalEditarProjeto.php', 'click-editar-projeto', '.modalEditarProjeto', '#modalEditarProjeto');
abrirModal('.btn-excluir-projeto', 'tr', 'id-projeto', 'include/cModalExcluirProjeto.php', 'click-excluir-projeto', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-editar-area-formacao', 'tr', 'id-area-formacao', 'include/cModalEditarAreaFormacao.php', 'click-editar-area-formacao', '.modalEditarAreaFormacao', '#modalEditarAreaFormacao');
abrirModal('.btn-excluir-area-formacao', 'tr', 'id-area-formacao', 'include/cModalExcluirAreaFormacao.php', 'click-excluir-area-formacao', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-excluir-tecnologia', 'tr', 'id-tecnologia', 'include/cModalExcluirTecnologia.php', 'click-excluir-tecnologia', '.modalExcluir', '#modalExcluir');

abrirModal('.btn-editar-imagem', 'tr', 'id-imagem', 'include/cModalEditarImagem.php', 'click-editar-imagem', '.modalEditarImagem', '#modalEditarImagem');
