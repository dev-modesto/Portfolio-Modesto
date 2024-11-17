let windowMetade; 

function tamanhoJanela() {
    if (window.innerHeight <= 1000) {
        windowMetade = window.innerHeight * 0.7; 

    } else {
        windowMetade = window.innerHeight * 0.5; 
    }
}

tamanhoJanela();
window.addEventListener('resize', () => {
    tamanhoJanela();
});

function animaScroll() {
    const section = document.querySelectorAll('.js-scroll');

    section.forEach((section) => {
        const topSection = section.getBoundingClientRect().top;
        const sectionVisible = (topSection - windowMetade) < 0;

        if (sectionVisible) {
            section.classList.add('ativo');
        }
    })
}

animaScroll();
window.addEventListener('scroll', animaScroll);
