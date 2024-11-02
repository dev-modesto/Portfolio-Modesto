function marcadorImagem(valorIndice) {
    const indiceProjeto = valorIndice;
    const indiceImagem = [window['indiceAtual' + valorIndice]];

    const indiceImagemAtiva = indiceProjeto + indiceImagem;

    const marcadorAtivo = document.querySelector(`.indice-imagem-${indiceImagemAtiva}`);
    const marcadorProjeto = document.querySelector(`.indice-projeto-${indiceProjeto}`);
    const marcadoresImagem = marcadorProjeto.querySelectorAll('.marcador-imagem-projeto');

    marcadoresImagem.forEach(marcador => {
        marcador.classList.remove('ativo');
    });
    
    marcadorAtivo.classList.add('ativo');
}


function atualizaImagem(valorIndice) {
    const imagemProjeto = document.getElementById('imagem-projeto-' + valorIndice);
    imagemProjeto.src = window['imagensProjeto' + valorIndice][window['indiceAtual' + valorIndice]].caminho;

    marcadorImagem(valorIndice);
    
}

function prevImage(valorIndice) {
    const indiceAtual = window['indiceAtual' + valorIndice];
    window['indiceAtual' + valorIndice] = (indiceAtual > 0) ? indiceAtual - 1 : window['imagensProjeto' + valorIndice].length - 1;
    atualizaImagem(valorIndice);
}

function nextImage(valorIndice) {
    const indiceAtual = window['indiceAtual' + valorIndice];
    window['indiceAtual' + valorIndice] = (indiceAtual < window['imagensProjeto' + valorIndice].length - 1) ? indiceAtual + 1 : 0;
    atualizaImagem(valorIndice);
}