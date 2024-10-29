function animaScroll() {
    const windowMetade = window.innerHeight * .5;
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
