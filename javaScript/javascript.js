var btn_menu = document.querySelector('#btn_menu')
var mobile_menu = document.getElementById('mobile_menu')

btn_menu.addEventListener('click', function(){
    mobile_menu.classList.toggle('expand_menu')

})

window.addEventListener('scroll', function () {
    if (window.scrollY > 400 ){
    mobile_menu.classList.remove('expand_menu');
    }
})

function animar(){  
    const btn = document.getElementById('btn_menu')
        btn.classList.toggle('ativar')
}
