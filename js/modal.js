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

                var arrayAutores = [];

                $('#btn-adicionar-autor-editar').click(function (e){

                    e.preventDefault();

                    var idAutor = $('.form-autores-projeto-editar').val();
                    idAutor = Number(idAutor);
                    var nomeAutor = $('#autores-projeto-editar option:selected').text();
                    
                    if (idAutor === 0 || arrayAutores.includes(idAutor)) {
                        return;
                        
                    } else {
                        arrayAutores.push(idAutor);
                    }

                    $('#autores-editar').val(arrayAutores.join(','));

                    $('.container-autores-projeto.editar').append(`
                        <div class="autor-item" data-id="${idAutor}">
                            <a class="btn-remover-autor-editar icone-excluir-autor" href="#" data-id="${idAutor}"><span class="icon-btn-controle material-symbols-rounded">close</span></a><span class="nome-autor">${nomeAutor}</span>
                        </div>
                    `);
                });

                var idAutores = $('#autores-editar').val();
                var arrayAutores = idAutores ? idAutores.split(',').map(Number) : [];

                $(document).on('click', '.btn-remover-autor-editar', function () {
                    var idAutor = $(this).data('id');
                    
                    if (arrayAutores.includes(idAutor)) {
                        const index = arrayAutores.indexOf(idAutor);
                        arrayAutores.splice(index, 1);
                    } 

                    $('#autores-editar').val(arrayAutores.join(','));
                    $(`.autor-item[data-id="${idAutor}"]`).remove();
                });

                var projetoEquipeEditar = $('input[name="projeto-equipe-editar"]:checked').val();
                var containerPrincipalAutoresEditar = $('.container-principal-autores-projeto.editar')[0];

                function visibilidadeContainerAutoresEditar(projetoEquipeEditar) {
                    if (projetoEquipeEditar == 'Nao') {
                        containerPrincipalAutoresEditar.style.display = 'none';
        
                    } else {
                        containerPrincipalAutoresEditar.style.display = 'block';
                    }
                }

                visibilidadeContainerAutoresEditar(projetoEquipeEditar);

                $('.projeto-equipe-editar').change(function (e) { 
                    e.preventDefault();
        
                    var projetoEquipeEditar = $(this).val();
                    visibilidadeContainerAutoresEditar(projetoEquipeEditar);
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