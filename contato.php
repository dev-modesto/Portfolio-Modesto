<?php
    include 'config/base.php';
    include BASE_PATH . "/include/header/headerPagContato.php";

?>

        <main>
            <section class="contato js-scroll" id="contato">
                <h1 class="font-1-h2-b cor-c3">Contato</h1>
                <p class="font-2-lg-r cor-c3">Gostou do meu trabalho ou tem uma proposta? <br> Envie-me uma mensagem.</p>
                
                <form class="container-form-contato">
                    <div class="item-nome">
                        <label for="nome" class="font-1-s-2">Nome</label>
                        <input type="text" id="nome" name="nome" placeholder="Nome e Sobrenome" required>
                    </div>

                    <div class="item-email">
                        <label for="email" class="font-1-s-2">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Seu_email@mail.com" required>
                    </div>

                    <div class="item-telefone">
                        <label for="telefone" class="font-1-s-2">Telefone</label>
                        <input type="fone" id="telefone" name="telefone" placeholder="(99) 99999-9999" required>
                    </div>

                    <div class="item-titulo-mensagem col-valor">
                        <label for="titulo-mensagem" class="font-1-s-2">Título da mensagem</label>
                        <input type="text" id="titulo-mensagem" name="titulo-mensagem" placeholder="Título da sua mensagem" required>
                    </div>

                    <div class="item-mensagem col-valor">
                        <label for="mensagem" class="font-1-s-2">Mensagem</label>
                        <textarea id="mensagem" name="mensagem" placeholder="Como posso te ajudar?" required></textarea>
                    </div>
                    
                    <div class="container-footer-contato col-valor">
                        <button class="btn-acao-contato font-1-s-2 peso-semi-bold" type="">Enviar</button>
                    </div>

                    <span class="forma-contato"></span>
                </form>
            </section>
            <?php
                include BASE_PATH . "/include/footer/footer.php";
                include BASE_PATH . "/include/footer/footerScripts.php";
            ?>
        </main>
    </body> 
</html>

<script>
 
    $(document).ready(function () {

        function statusItensForm(parametro) {
            $('.item-nome input').attr('disabled', parametro);
            $('.item-email input').attr('disabled', parametro);
            $('.item-telefone input').attr('disabled', parametro);
            $('.item-titulo-mensagem input').attr('disabled', parametro);
            $('.item-mensagem textarea').attr('disabled', parametro);
            $('.btn-acao-contato').attr('disabled', parametro);
        }

        function limparFormulario() {
            $('.item-nome input').val('');
            $('.item-email input').val('');
            $('.item-telefone input').val('');
            $('.item-titulo-mensagem input').val('');
            $('.item-mensagem textarea').val('');
            $('.btn-acao-contato').val('');
        }

        const btnEnviarEmail = $('.btn-acao-contato')[0];
        const containerFooter = $('.container-footer-contato')[0];
        
        $('.container-form-contato').submit(function (e) {
            e.preventDefault();
            const dadosFormulario = new FormData(this);

            $.ajax({
                type: "post",
                url: "servicos/contato/enviarEmail.php",
                data: dadosFormulario,
                contentType: false,
                processData: false,
                
                beforeSend: function () {
                    btnEnviarEmail.innerHTML = 'Enviando... <svg width="24" height="24" stroke="#45D7C6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><circle cx="12" cy="12" r="9.5" fill="none" stroke-width="3" stroke-linecap="round"><animate attributeName="stroke-dasharray" dur="1.5s" calcMode="spline" values="0 150;42 150;42 150;42 150" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="1.5s" calcMode="spline" values="0;-16;-59;-59" keyTimes="0;0.475;0.95;1" keySplines="0.42,0,0.58,1;0.42,0,0.58,1;0.42,0,0.58,1" repeatCount="indefinite"/></circle><animateTransform attributeName="transform" type="rotate" dur="2s" values="0 12 12;360 12 12" repeatCount="indefinite"/></g></svg>';

                    statusItensForm(true);

                },
                success: function (response) {

                    if(response.sucesso) {
                        limparFormulario();
                        btnEnviarEmail.innerHTML = 'Mensagem enviada <span class="material-symbols-rounded cor-p4">check</span>';

                        setTimeout(() => {
                        statusItensForm(false);
                            btnEnviarEmail.innerHTML = 'Enviar';
                        }, 2000);

                    } else {
                        limparFormulario();
                        containerFooter.innerHTML = '<div class="container-error-mensagem"><p class="texto-error"><span class="material-symbols-rounded">error</span>Ocorreu um erro. Não foi possível enviar a mensagem.</p><div>';
                        
                        setTimeout(() => {
                            statusItensForm(false);
                            containerFooter.innerHTML = '<button class="btn-acao-contato font-1-s-2 peso-semi-bold">Enviar</button>';
                        }, 3000);
                    }
                },
                error: function(response) {
                    limparFormulario();
                    containerFooter.innerHTML = '<div class="container-error-mensagem"><p class="texto-error"><span class="material-symbols-rounded">error</span>Ocorreu um erro. Não foi possível enviar a mensagem.</p><div>';
                    
                    setTimeout(() => {
                        statusItensForm(false);
                        containerFooter.innerHTML = '<button class="btn-acao-contato font-1-s-2 peso-semi-bold">Enviar</button>';
                    }, 3000);
                }
            });
        })
    });

</script>
