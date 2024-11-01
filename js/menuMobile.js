const dropdown = document.getElementById('dropdown-menu');
const icon = document.getElementById('iconProjetos');

activedrop.onclick = () => {
    if(dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
        icon.style.rotate = '0deg';
    } else {
        dropdown.style.display = 'block';
        icon.style.rotate = '180deg';
    }
}

const iconMobile = document.getElementById('icon-mobile');
const menuMobile = document.getElementById('drop-menu-mobile');
const navbar = document.getElementById('navbar');
const logo1 = document.getElementById('logo1');
const logo2 = document.getElementById('logo2');

iconMobile.onclick = () => {
    
    if (menuMobile.classList.contains('ativo')){
        atribuirClassesMenuMobile('menu', 'var(--color-s6)', '#fff', 'block', 'none');
        menuMobile.classList.remove('ativo');

    } else {
        atribuirClassesMenuMobile('close', '#77FCED', 'var(--color-s6)', 'none', 'block');
        menuMobile.classList.add('ativo');
    }

    fecharMenuMobile();
}

function atribuirClassesMenuMobile(icone, corIcone, backgroundColor, logoDisplay1, logoDisplay2) {
    iconMobile.innerHTML = icone;
    iconMobile.style.color = corIcone;
    navbar.style.backgroundColor = backgroundColor;
    logo1.style.display = logoDisplay1;
    logo2.style.display = logoDisplay2;
}

function fecharMenuMobile() {
    const itensMenuMobile = document.querySelectorAll('.menu-mobile-itens li');
    itensMenuMobile.forEach((item) => {

        item.addEventListener('click', () => {
            atribuirClassesMenuMobile('menu', 'var(--color-s6)', '#fff', 'block', 'none');
            menuMobile.classList.remove('ativo');
        })
    }) 
}