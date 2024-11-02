function initAccordion() {
    const titulosAccordion = document.querySelectorAll('.accordion-titulo');

    titulosAccordion.forEach(titulo => {
        titulo.removeEventListener('click', accordionClickHandler);
        titulo.addEventListener('click', accordionClickHandler);
    });
}

function accordionClickHandler() {
    const conteudo = this.nextElementSibling;
    const tituloAtual = this;
    const containerAtual = this.closest('.accordion-container');
    
    const allTitulos = this.closest('.card-projeto-accordion').querySelectorAll('.accordion-titulo');
    allTitulos.forEach(titulo => {
        titulo.classList.remove('ativo');
    });

    const allContainer = this.closest('.card-projeto-accordion').querySelectorAll('.accordion-container');
    allContainer.forEach(containerAccordion => {
        containerAccordion.classList.remove('ativo');
    });

    const conteudoAtivo = conteudo.classList.contains('ativo');

    if (conteudoAtivo) {
        tituloAtual.classList.remove('ativo');
        containerAtual.classList.remove('ativo');

    } else {
        tituloAtual.classList.add('ativo');
        containerAtual.classList.add('ativo');
    }

    const allConteudos = this.closest('.card-projeto-accordion').querySelectorAll('.accordion-conteudo');
    allConteudos.forEach(item => {
        if (item !== conteudo) {
            item.classList.remove('ativo');
        }
    });

    conteudo.classList.toggle('ativo');
}
