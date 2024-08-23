document.addEventListener('DOMContentLoaded', function () {

    window.addEventListener('load', function () {
        const loader = document.querySelector('.page-loader');
        const content = document.querySelector('.conteudo');
        
        if (loader) {
            loader.style.display = 'none';
        }
        
        if (content) {
            content.style.display = 'block';
        }
    });
});
