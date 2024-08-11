const links = document.querySelectorAll(".navbar-itens a");

function ativarLink(link) {
    const url = window.location.href;
    const href = link.href;

    if (url.includes(href)){
        link.classList.add('link-ativo');
    }
}

links.forEach(ativarLink);

var ativarMenu = document.querySelector(".usuario-info");
var usuarioDropdown = document.querySelector(".usuario-logado-dropdown");
var icon = document.querySelector(".ico-icodown");

ativarMenu.addEventListener('click', function(){
    
    if(usuarioDropdown.style.display === 'block'){
        usuarioDropdown.style.display = 'none';
        icon.style.rotate = '0deg';
    } else {
        usuarioDropdown.style.display = 'block';
        icon.style.rotate = '180deg';
    }
})


const linksSubHeader = document.querySelectorAll('.container-header-itens li a');
    function ativarLinkSubMenu(link){
        const url = window.location.href;
        const href = link.href;

        if (url.includes(href)){
            link.classList.add('link-ativo-sub-menu');
        }
    }

linksSubHeader.forEach(ativarLinkSubMenu);


var dropdownAcomodacoes = document.querySelector(".dropdown-acomodacoes");
var cotainerDropdownAcomodacoes = document.querySelector(".container-dropwdown-acomodacoes");

if (dropdownAcomodacoes) {
    dropdownAcomodacoes.addEventListener('click', function() {

        if(cotainerDropdownAcomodacoes.style.display === 'block'){
            cotainerDropdownAcomodacoes.style.display = 'none';
            icon.style.rotate = '0deg';
        } else {
            cotainerDropdownAcomodacoes.style.display = 'block';
            icon.style.rotate = '180deg';
        }

    })
}

var botaoMinMenu = document.querySelector(".botao-menu");
var botaoMinMenuIcone = document.querySelector(".botao-menu span");
var menuLateral = document.querySelector(".container-navbar-lateral");
var bodyMin = document.querySelector("body");
var menuPrincipalMin = document.querySelector(".principal-container-header");
var menuTopMin = document.querySelector(".container-header-itens");
var textoNav = document.querySelectorAll(".texto-nav");
var imgLogo = document.querySelector(".img-logo");


function menuMinMax () {

    if (botaoMinMenuIcone.style.rotate == '0deg') {
        botaoMinMenuIcone.style.rotate = '180deg'
    } else {
        botaoMinMenuIcone.style.rotate = '0deg'
    }

    menuLateral.classList.toggle("menu-min");
    bodyMin.classList.toggle("min");
    menuPrincipalMin.classList.toggle("header-principal-min");

    if (menuTopMin) {
        menuTopMin.classList.toggle("header-sub-min");
    }
    
    textoNav.forEach(function(element) {

        if (element.style.display == "none") {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });

    var logoMax = imgLogo.getAttribute('data-logoMax');
    var logoMin = imgLogo.getAttribute('data-logoMin');
    
    var currentSrc = imgLogo.src;
    
    if (novaImg = currentSrc.includes('logo-white')) {
        novaImg = logoMin
    } else {
        novaImg = logoMax
    }
    imgLogo.src = novaImg;

}

function menuOculto() {

    if (botaoMinMenuIcone.style.rotate == '180deg') {
        botaoMinMenuIcone.style.rotate = '0deg'
    } else {
        botaoMinMenuIcone.style.rotate = '180deg'
    }

    menuLateral.classList.toggle("menu-oculto");
    bodyMin.classList.toggle("min-pequeno");
    menuPrincipalMin.classList.toggle("header-principal-min-pequeno");

    if (menuTopMin) {
        menuTopMin.classList.toggle("header-sub-min-pequeno");
    }
    
    textoNav.forEach(function(element) {

        if (element.style.display == "none") {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });

    var logoMax = imgLogo.getAttribute('data-logoMax');
    var logoMin = imgLogo.getAttribute('data-logoMin');
    
    var currentSrc = imgLogo.src;
    
    if (novaImg = currentSrc.includes('logo-white')) {
        novaImg = logoMin
    } else {
        novaImg = logoMax
    }
    imgLogo.src = novaImg;

}

function menuMenor() {
    if (botaoMinMenuIcone.style.rotate == '180deg') {
        botaoMinMenuIcone.style.rotate = '0deg'
    } else {
        botaoMinMenuIcone.style.rotate = '180deg'
    }

    menuLateral.classList.toggle("menu-min");
    bodyMin.classList.toggle("min");
    menuPrincipalMin.classList.toggle("header-principal-min");

    if (menuTopMin) {
        menuTopMin.classList.toggle("header-sub-min");
    }
    
    textoNav.forEach(function(element) {

        if (element.style.display == "none") {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    });

    var logoMax = imgLogo.getAttribute('data-logoMax');
    var logoMin = imgLogo.getAttribute('data-logoMin');
    
    var currentSrc = imgLogo.src;
    
    if (novaImg = currentSrc.includes('logo-white-min')) {
        novaImg = logoMax
    } else {
        novaImg = logoMin
    }
    imgLogo.src = novaImg;
}

botaoMinMenu.addEventListener('click', function() {
    if (window.innerWidth < 1024) {
        menuOculto();
        
    } else {
        menuMenor();
    }
})

function removeClasses() {

    botaoMinMenuIcone.style.rotate = '0deg'

    menuLateral.classList.remove("menu-min");
    menuLateral.classList.remove("menu-oculto");
    bodyMin.classList.remove("min-pequeno");
    bodyMin.classList.remove("min");
    menuPrincipalMin.classList.remove("header-principal-min-pequeno");
    menuPrincipalMin.classList.remove("header-principal-min");

    if (menuTopMin) {
        menuTopMin.classList.remove("header-sub-min-pequeno");
        menuTopMin.classList.toggle("header-sub-min");
    }
    
    var logoMax = imgLogo.getAttribute('data-logoMax');
    imgLogo.src = logoMax;

    textoNav.forEach(function(element) {
        element.style.display = 'block';
    });
}

function adicionaClasses() {

    botaoMinMenuIcone.style.rotate = '180deg'

    menuLateral.classList.add("menu-min");
    menuLateral.classList.add("menu-oculto");
    bodyMin.classList.add("min-pequeno");
    bodyMin.classList.add("min");
    menuPrincipalMin.classList.add("header-principal-min-pequeno");
    menuPrincipalMin.classList.add("header-principal-min");

    if (menuTopMin) {
        menuTopMin.classList.add("header-sub-min-pequeno");
        menuTopMin.classList.add("header-sub-min");
    }
    
    var logoMax = imgLogo.getAttribute('data-logoMax');
    imgLogo.src = logoMax;

    textoNav.forEach(function(element) {
        element.style.display = 'block';
    });
}

let classesAplicadas = false;

function verificaTamanho() {
    if (window.innerWidth < 1024 && !classesAplicadas) {
        adicionaClasses();
        classesAplicadas = true; 

    } else if (window.innerWidth > 1024 && classesAplicadas) {
        removeClasses();
        classesAplicadas = false;  
    }
}

verificaTamanho();

window.addEventListener('resize', verificaTamanho);