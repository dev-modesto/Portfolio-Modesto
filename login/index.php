<?php 
    include '../config/base.php';
    include BASE_PATH . '/include/funcoes/diversas/mensagem.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/fonts.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/css/componentes/cor.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/login/login.css">
</head>
<body>
    
    <div class="container-forma">
        <div class="container-login">
            <div>      
                <div class="container-img">
                    <a href="https://devmodesto.com.br"><img src="../assets/img/logo/logo-black.svg" alt="logo"></a>
                </div>
                <h1>Login</h1>
                <form class="container-formulario">
                    <div class="container-usuario">
                        <label class="font-1-s peso-medio" for="usuario">Usuário</label>
                        <div class="container-input-usuario">
                            <input class="font-1-s" type="text" name="login-usuario" id="usuario">
                            <span class="icone-login icone-matricula"></span>
                        </div>
                    </div>
                    <div class="container-senha">
                        <label class="font-1-s peso-medio" for="senha">Senha</label>
                        <div class="container-input-senha">
                            <span class="icone-login icone-senha"></span>
                            <input class="font-1-s" type="password" name="senha" id="senha">
                            <span class="icone-login icone-ver-senha"></span>
                        </div>
                    </div>
                    <div class="container-button">
                        <button class="btn-entrar font-1-s peso-semi-bold" type="submit">Entrar</button>
                    </div>
                </form>
                <?php
                    mensagemInvalida();
                ?>
            </div>
            <div class="rodape-login">
                <span class="versao-portfolio">versão 2.0.0</span>
                <p>© 2024 · Desenvolvido por <span>devModesto</span></p>
            </div>
        </div>
    </div>
</body>
</html>

<!-- arquivos js importação bibliotecas -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    $(document).ready(function () {
        
        $('.btn-entrar').click(function (e) { 
            e.preventDefault();
            const usuario = $("#usuario").val();
            const senha = $("#senha").val();

            $.ajax({
                type: "POST",
                url: "include/cLogin.php",
                data: {
                    'click-login': true,
                    'login-usuario': usuario,
                    'senha': senha
                },
                success: function (response) {
                    const redirecionamento = response.caminho;

                    if (response.sucesso) {
                        window.location.href = redirecionamento;

                    } else {
                        window.location.href = '../login/index.php?msgInvalida=' + encodeURIComponent(response.mensagem);
                    }
                }
            });
            
        });

        $('.icone-ver-senha').click(function (e) { 
            e.preventDefault();
            
            const inputSenha = $('#senha')[0];
            const iconVerSenha = $('.icone-ver-senha')[0];

            if (inputSenha.type === 'password') {
                inputSenha.type = 'text';
                iconVerSenha.classList.add('visible');

            } else {
                inputSenha.type = 'password';
                iconVerSenha.classList.remove('visible');
            }
        });

        function validaInput() {
        
            var valInputUsuario = $('#usuario').val();
            var valInputSenha = $('#senha').val();

            var usuarioValido = valInputUsuario !== "" && valInputUsuario.length > 4;
            var senhaValida = valInputSenha !== "" && valInputSenha.length > 8;

            if (usuarioValido && senhaValida) {
                $('.btn-entrar').prop('disabled', false);
                $('.btn-entrar').css('cursor', 'pointer');

            } else {
                $('.btn-entrar').prop('disabled', true);
                $('.btn-entrar').css('cursor', 'not-allowed');
            }

            $('#usuario').toggleClass('is-invalid', !usuarioValido);
            $('#senha').toggleClass('is-invalid', !senhaValida);
        }

        $('#usuario').on('keyup', validaInput);
        $('#senha').on('keyup', validaInput);

    });

    $('#usuario').mask('0000000');

</script>