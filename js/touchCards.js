function verificaTouch() {
    const cardVerso = document.querySelectorAll('.projetoDestaque-cards-verso');
    const todosImgFrontal = document.querySelectorAll('.conteudo-img');
    const cardsCertificados = document.querySelectorAll('.card-formacao-verso');
    const widthMinDesktop = 800;

    if ('ontouchstart' in window) {
        cardVerso.forEach(cards => {
            cards.classList.remove('desk');
        });

        todosImgFrontal.forEach(frontalImg => {
            frontalImg.classList.remove('desk');
        });
        
        cardsCertificados.forEach(cardCertificado => {
            cardCertificado.classList.remove('desk');
        });
        
    } else if (window.innerWidth >= widthMinDesktop) {
        cardVerso.forEach(cards => {
            cards.classList.add('desk');
        });

        todosImgFrontal.forEach(frontalImg => {
            frontalImg.classList.add('desk');
        });

        cardsCertificados.forEach(cardCertificado => {
            cardCertificado.classList.add('desk');
        });

    } else {
        cardVerso.forEach(cards => {
            cards.classList.add('desk');
        });

        todosImgFrontal.forEach(frontalImg => {
            frontalImg.classList.add('desk');
        });

        cardsCertificados.forEach(cardCertificado => {
            cardCertificado.classList.add('desk');
        });
    }
}


function telaTouchCardFormacao(event, elemento) {

    if ('ontouchstart' in window) {
        var elementoCardFormacao = elemento;
        const cardFormacaoVerso = elementoCardFormacao.querySelector('.card-formacao-verso');
        const todosCardsFormacoesVersos = document.querySelectorAll('.card-formacao-verso');

        if (event.target.tagName.toLowerCase() === 'a') {
            return;
        }

        if (cardFormacaoVerso && !cardFormacaoVerso.classList.contains('ativo')) {
            event.preventDefault();
            event.stopPropagation();

            todosCardsFormacoesVersos.forEach(versoCardFormacao => {
                if (versoCardFormacao.classList.contains('ativo')) {
                    versoCardFormacao.classList.remove('ativo');
                } 
            });

            cardFormacaoVerso.classList.add('ativo');
                
        } else {
            cardFormacaoVerso.classList.remove('ativo');
        }

        function fecharCardClickForaFormacao() {
            document.addEventListener('click', function(e) {
                if (!elementoCardFormacao.contains(e.target) && cardFormacaoVerso.classList.contains('ativo')) {
                    cardFormacaoVerso.classList.remove('ativo');
                }
            });
        }

        function fecharCardScrollFormacao() {
            document.addEventListener('scroll', function(e) {
                if (!elementoCardFormacao.contains(e.target) && cardFormacaoVerso.classList.contains('ativo')) {
                    cardFormacaoVerso.classList.remove('ativo');
                }
            });
        }

        fecharCardClickForaFormacao();
        fecharCardScrollFormacao();
    }
}

function telaTouchProjetosDestaques(event, elemento) {

    if ('ontouchstart' in window) {
        var meuElemento = elemento;
        const cardVerso = meuElemento.querySelector('.projetoDestaque-cards-verso');
        const todosVersosCards = document.querySelectorAll('.projetoDestaque-cards-verso');
        const todosImgFrontal = document.querySelectorAll('.conteudo-img');
        const cardConteudoImg =  meuElemento.querySelector('.projetoDestaque-cards--conteudo');

        if (event.target.tagName.toLowerCase() === 'a') {
            return;
        }

        if (cardVerso && !cardVerso.classList.contains('ativo')) {
            event.preventDefault();
            event.stopPropagation();
            
            todosVersosCards.forEach(verso => {
                if (verso.classList.contains('ativo')) {
                    verso.classList.remove('ativo');
                } 
            });

            todosImgFrontal.forEach(frontalImg => {
                if (frontalImg.classList.contains('ativo-img')) {
                    frontalImg.classList.remove('ativo-img');
                }
            });
            
            cardVerso.classList.add('ativo');
            cardConteudoImg.classList.add('ativo-img');

        } else {
            cardConteudoImg.classList.remove('ativo-img');
            cardVerso.classList.remove('ativo');
        }

        function fecharCardClickForaProjetosDestaques() {
            document.addEventListener('click', function(e) {
                if (!meuElemento.contains(e.target) && cardVerso.classList.contains('ativo')) {
                    cardVerso.classList.remove('ativo');
                    cardConteudoImg.classList.remove('ativo-img');
                }
            });
        }

        function fecharCardScroll() {
            document.addEventListener('scroll', function(e) {
                if (!meuElemento.contains(e.target) && cardVerso.classList.contains('ativo')) {
                    cardVerso.classList.remove('ativo');
                    cardConteudoImg.classList.remove('ativo-img');
                }
            });
        }

        fecharCardClickForaProjetosDestaques();
        fecharCardScroll();
    }
}
