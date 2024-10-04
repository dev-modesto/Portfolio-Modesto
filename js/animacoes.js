const section = document.querySelectorAll('.js-scroll');

const windowMetade = window.innerHeight * .5;

function animaScroll() {
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
