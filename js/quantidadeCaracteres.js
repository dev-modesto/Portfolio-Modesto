
function quantidadeCaracteresEditar(descricaoProjeto, containerFeedback) {

    let texto = $(descricaoProjeto).val();
    let qntCaracteres = texto.length;

    $(containerFeedback).find('.feedback-caracteres').text(qntCaracteres + ' caracteres');

    const classeContainerFeedback = '.descricao-funcionalidades-feedback';

    adicionarClasseCaractere(classeContainerFeedback, containerFeedback, qntCaracteres);

    $(descricaoProjeto).keyup(function(e) {
        e.preventDefault();

        let texto = $(this).val();
        let qntCaracteres = texto.length;
        $(containerFeedback).find('.feedback-caracteres').text(qntCaracteres + ' caracteres');

        const classeContainerFeedback = '.descricao-funcionalidades-feedback';
        adicionarClasseCaractere(classeContainerFeedback, containerFeedback, qntCaracteres);
    })
}

function quantidadeCaracteres(descricaoProjeto, containerFeedback) {

    $(descricaoProjeto).keyup(function(e) {
        e.preventDefault();

        const texto = $(this).val();
        const qntCaracteres = texto.length;

        $(containerFeedback).find('.feedback-caracteres').text(qntCaracteres + ' caracteres');

        const classeContainerFeedback = '.descricao-funcionalidades-feedback';
        adicionarClasseCaractere(classeContainerFeedback, containerFeedback, qntCaracteres);
    })
}

function adicionarClasseCaractere(containerClasseFeedback, containerFeedback, qntCaracteres) {

    if (containerFeedback == containerClasseFeedback) {
        if (qntCaracteres > 600) {
            $(containerFeedback).addClass('alert-1');

        } else {
            $(containerFeedback).removeClass('alert-1');
        }

    } else {

        if (qntCaracteres > 400) {
            $(containerFeedback).addClass('alert-1');

        } else {
            $(containerFeedback).removeClass('alert-1');
        }
    }
}


// Função para resetar o feedback de caracteres
function resetarFeedbackCaracteres(containerFeedback) {
    $(containerFeedback).find('.feedback-caracteres').text('0 caracteres');
    $(containerFeedback).removeClass('alert-1');
}
