<?php
    include '../../config/base.php';

    if(isset($_POST['click-login'])) {
        $login = $_POST['login-usuario'];
        $senha = trim($_POST['senha']);

        if (empty($login) || empty($senha)) {
            $mensagem['mensagem'] = "Não é possível o envio de campos vazios.";
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        }
        
        if(!is_numeric($login) || strlen($login) < 5) {
            $mensagem['mensagem'] = "Ooops, isso não é possível.";
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        } 
        
        $login = intval($login);
        $hash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = mysqli_prepare($con, "SELECT * FROM tbl_login WHERE login = ?");
        mysqli_stmt_bind_param($sql, 'i', $login);
        mysqli_stmt_execute($sql);
        $result = mysqli_stmt_get_result($sql);
        $array = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result)) {
            $loginDb = $array['login'];
            $nome = $array['nome'];
            $senhaDb = $array['senha'];

            if (password_verify($senha, $senhaDb)) {
                session_start();
                $_SESSION['login'] = $loginDb;
                $_SESSION['nome'] = $nome;


                $caminho = '../app/administracao/projeto/';
                $mensagem['sucesso'] = true;
                $mensagem['caminho'] = $caminho;
                header('Content-Type: application/json');
                echo json_encode($mensagem);

            } else {
                $mensagem['mensagem'] = 'Senha incorreta.';
                header('Content-Type: application/json');
                echo json_encode($mensagem);
                die();
            }

        } else {
            $mensagem['mensagem'] = 'Usuário ou senha incorreta.';
            header('Content-Type: application/json');
            echo json_encode($mensagem);
            die();
        }

    } else {
        header('location: ../index.php');
    }

?>