var btn_menu = document.querySelector('#btn_menu')
var mobile_menu = document.getElementById('mobile_menu')
const btn = document.getElementById('btn_menu')

btn_menu.addEventListener('click', function () {
    mobile_menu.classList.toggle('expand_menu')

})

function animar() {
    btn.classList.toggle('ativar')
}

function closemenu() {
    btn.classList.remove('ativar')
    mobile_menu.classList.remove('expand_menu');
}


window.addEventListener('scroll', function () {
    let back_top = document.querySelector('.back_top')
    back_top.classList.toggle('active', window.scrollY > 700)

    if (window.scrollY > 400) {
        mobile_menu.classList.remove('expand_menu');
        btn.classList.remove('ativar');
    }
})

