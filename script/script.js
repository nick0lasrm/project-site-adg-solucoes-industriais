/* Mobile menu */

// Seleciona o menu e o botão (Mobile)
var mobile_menu = document.getElementById('mobile_menu')
var btnMenu = document.getElementById('btn_menu')

// Função para abrir ou fechar menu (Mobile)
function animar() {
    btnMenu.classList.toggle('ativar')
    mobile_menu.classList.toggle('expand_menu')
}

window.addEventListener('scroll', function () {
    // Ativa ou desativa botão usado para voltar ao topo descendo ou subindo a página (Mobile)
    let back_top = document.querySelector('.back_top')
    back_top.classList.toggle('active', window.scrollY > 600)

    // Fecha o menu descendo a página (Mobile)
    if (window.scrollY > 400) {
        mobile_menu.classList.remove('expand_menu');
        btnMenu.classList.remove('ativar');
    }
})