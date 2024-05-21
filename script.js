var dropdown = document.getElementById('dropdown-menu');
var icon = document.getElementById('iconProjetos');

activedrop.onclick = () => {
    if(dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
        icon.style.rotate = '0deg';
    } else {
        dropdown.style.display = 'block';
        icon.style.rotate = '180deg';
    }
}

var dropMobile = document.getElementById('drop-mobile');
var iconMobile = document.getElementById('icon-mobile');
var menuMobile = document.getElementById('drop-menu-mobile');
var navbar = document.getElementById('navbar');
var logo1 = document.getElementById('logo1');
var logo2 = document.getElementById('logo2');


iconMobile.onclick = () => {
    // alert('clicado!');
    
    if (menuMobile.style.display === 'flex'){
        menuMobile.style.display = 'none';
        iconMobile.innerHTML = 'menu';
        iconMobile.style.color = 'var(--color-s6)';
        navbar.style.backgroundColor = '#fff';
        logo1.style.display = 'block';
        logo2.style.display = 'none';
    } else {
        menuMobile.style.display = 'flex';
        iconMobile.innerHTML = 'close';
        iconMobile.style.color = '#77FCED';
        navbar.style.backgroundColor = 'var(--color-s6)';
        logo1.style.display = 'none';
        logo2.style.display = 'block';
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const icons = document.querySelectorAll(".habilidades-icons");

    icons.forEach(icon => {
        icon.addEventListener("mouseover", function() {
            this.src = this.getAttribute("data-original");
        });

        icon.addEventListener("mouseout", function() {
            this.src = this.getAttribute("data-plain");
        });
    });
});


