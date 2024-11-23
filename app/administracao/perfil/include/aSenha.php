<?php 
    include '../../../../config/base.php';
    include BASE_PATH . '/include/funcoes/diversas/respostaJson.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
            $login = $_SESSION['login'];
        }

        $senhaAtual = $_POST['senha-atual'];
        $novaSenha = $_POST['nova-senha'];
        $repetirNovaSenha = $_POST['repetir-nova-senha'];

        $sql = mysqli_prepare($con, "SELECT * FROM tbl_login WHERE login = ?");
        mysqli_stmt_bind_param($sql, 's', $login);
        mysqli_stmt_execute($sql);
        $result = mysqli_stmt_get_result($sql);
        $array = mysqli_fetch_assoc($result);
        
        $senhaDb = $array['senha'];

        if (password_verify($senhaAtual, $senhaDb)) {

            if ($novaSenha === $repetirNovaSenha) {
                $hashNovaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
                mysqli_begin_transaction($con);

                try {
                    $sql = mysqli_prepare($con, "UPDATE tbl_login SET senha = ? WHERE login = ?");
                    mysqli_stmt_bind_param($sql, 'ss', $hashNovaSenha, $login);
                    mysqli_stmt_execute($sql);

                    mysqli_commit($con);
                    $mensagem = ['sucesso' => true, 'mensagem' => 'Senha atualizada com sucesso!'];
                    respostaJson($mensagem);

                } catch (Exception $e) {
                    mysqli_rollback($con);
                    $mensagem['mensagem'] = 'Ocorreu um error interno. Não foi possível atualizar a senha.';
                    respostaJson($mensagem);
                }

            } else {
                $mensagem = ['mensagem' => 'Senhas não coincidem. Não foi possível atualizar.'];
                respostaJson($mensagem);
            }

        } else {
            $mensagem['mensagem'] = 'Senha atual incorreta.';
            respostaJson($mensagem);
        }

    } else {
        header('Location: ../index.php');
    }

?>