<?php
    include '../../../config/base.php';
    include SEGURANCA;
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
    include BASE_PATH . '/include/funcoes/dbQuery/autor.php';
    
    $tituloPaginaHead = 'Meu perfil | Administração | devModesto';
    $tituloPagina = 'Meu perfil';
    
    include BASE_PATH . '/include/head/headPagAdministracao.php';

    if(session_status() == PHP_SESSION_ACTIVE){
        $nomeUsuario = $_SESSION['nome'];
    }
?>

<body>
<?php
    include BASE_PATH . '/include/preLoad/preLoad.php';
    include BASE_PATH . "/include/menu/sidebar.php";
?>

<div class="conteudo">

    <?php
        mensagemValida();
        mensagemInvalida();
    ?>

    <div class="container-principal perfil">

        <section class="container-perfil">
            <div class="info-perfil">

                <div class="info-perfil-imagem">
                    <img src="" alt="">
                </div>
                <div class="info-perfil-texto">
                    <h1><?= $nomeUsuario ?></h1>
                    <span>Administrador</span>
                </div>
                <div class="info-perfil-conteudo">
                    <div class="info-perfil-container-button">
                        <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#modalPerfil">Alterar senha</button>
                    </div>
                </div>

            </div>
        </section>
        
    </div>

    <div class="modal fade modal-sm " id="modalPerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar senha</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="form-container" id="form-alterar-senha">
                        <div class="mb-4">
                            <label class="font-1-s" for="senha-atual">Senha atual<em>*</em></label><br>
                            <input class="form-control" type="password" name="senha-atual" id="senha-atual" required>
                        </div>

                        <div class="mb-4">
                            <label class="font-1-s" for="nova-senha">Nova senha <em>*</em></label><br>
                            <input class="form-control" type="password" name="nova-senha" id="nova-senha" required>
                            <div class="container-feedback perfil nova-senha">
                                <span class="feedback-nova-senha font-1-sm-r cor-a-red4"></span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="font-1-s" for="repetir-nova-senha">Repita a nova senha <em>*</em></label><br>
                            <input class="form-control" type="password" name="repetir-nova-senha" id="repetir-nova-senha" required>
                            <div class="container-feedback perfil repetir-senha">
                                <span class="feedback-repetir-senha font-1-sm-r cor-a-red4"></span>
                            </div>
                        </div>

                        <div class="modal-footer form-container-button">
                            <button type="button" class="col btn btn-secondary btn-modal-cancelar" data-bs-dismiss="modal">Cancelar</button>
                            <button class='col btn btn-primary btn-alterar-senha' type="submit">Alterar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include BASE_PATH . '/include/footer/footerAdministracao.php';
?>

<script>

    $(document).ready(function () {

        $('#form-alterar-senha').submit(function (e) { 
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "post",
                url: "include/aSenha.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                    if (response.sucesso) {
                        window.location.href = '../perfil/index.php?msg=' + encodeURIComponent(response.mensagem);

                    } else {
                        window.location.href = '../perfil/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                    }
                },
                error: function(response) {
                    window.location.href = '../perfil/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                }
            });

        });

        var valorNovaSenha = ''; 
        var valorRepetirSenha = '';

        $('#nova-senha').on('keyup', function () {
            valorNovaSenha = $('#nova-senha').val();
            verificaSenha(valorNovaSenha, valorRepetirSenha);
        });

        $('#repetir-nova-senha').on('keyup', function () {
            valorRepetirSenha = $('#repetir-nova-senha').val();
            verificaSenha(valorNovaSenha, valorRepetirSenha);
        });

        function verificaSenha(novaSenha, repetirSenha) {
            var regexSenha = /^(?=.*[a-z])(?=.*[0-9])(?=.*[*!@#$%&])[A-Z][a-zA-Z0-9*!@#$%&]{8,15}$/;
            var tamNovaSenha = novaSenha.length > 8;
            var tamRepetirSenha = repetirSenha.length > 8;

            if (regexSenha.test(novaSenha)) {
                $('.container-feedback.perfil.nova-senha').html('<span class="material-symbols-rounded icon-check-feedback">check_circle</span>');
            
            } else {
                $('.container-feedback.perfil.nova-senha').html('<span class="feedback-nova-senha font-1-sm-r cor-a-red4"></span>');
                $('.feedback-nova-senha').text('Senha deve ter entre 9 e 16 caracteres.');
            }

            if(regexSenha.test(repetirSenha)) {

                if(repetirSenha === novaSenha) {
                    $('.container-feedback.perfil.repetir-senha').html('<span class="material-symbols-rounded icon-check-feedback">check_circle</span>');
                    $('.container-feedback.perfil.nova-senha').html('<span class="material-symbols-rounded icon-check-feedback">check_circle</span>');
                    $('.btn-alterar-senha').prop('disabled', false);
                    $('.btn-alterar-senha').css('cursor', 'pointer');

                } else {
                    $('.container-feedback.perfil').html('<span class="feedback-repetir-senha font-1-sm-r cor-a-red4"></span>');
                    $('.feedback-repetir-senha').text('Senhas não coincidem');
                    $('.feedback-nova-senha').text('Senhas não coincidem');
                    $('.btn-alterar-senha').prop('disabled', true);
                    $('.btn-alterar-senha').css('cursor', 'not-allowed');
                }

            } else {
                $('.feedback-repetir-senha').text('Senha deve ter entre 9 e 16 caracteres.');
                $('.btn-alterar-senha').prop('disabled', true);
                $('.btn-alterar-senha').css('cursor', 'not-allowed');
            }
       }});

       $('.btn-alterar-senha').prop('disabled', true);
       $('.btn-alterar-senha').css('cursor', 'not-allowed');

</script>
