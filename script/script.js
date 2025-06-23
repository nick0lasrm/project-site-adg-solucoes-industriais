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

    // o menu descendo a página (Mobile)
    if (window.scrollY > 400) {
        mobile_menu.classList.remove('expand_menu');
        btnMenu.classList.remove('ativar');
    }
})


/* Formulário */

// Seleciona o formulário, o botão de envio e o status
var form = document.getElementById('form');
var btnSubmit = document.getElementById('btnSubmit');
var statusForm = document.getElementById('statusForm');

// Função para lidar com o envio do formulário
async function handleSubmit(event) {
    // 1. Previne o comportamento padrão (recarregar a página
    event.preventDefault();
    // 2. Desabilita o botão e atualiza o texto para dar feedback
    btnSubmit.setAttribute('disabled', 'true');
    btnSubmit.textContent = "Enviando...";

    // 3. Envia os dados do formulário para o Formspree
    var data = new FormData(event.target);
    fetch(event.target.action, {
        method: form.method,
        body: data,
        headers: {
            'Accept': 'application/json'
        }
    }).then(response => {
        // 4. Verifica a resposta do Formspree
        if (response.ok) {
            // Se deu certo: mostra mensagem de sucesso e limpa o formulário
            statusForm.innerHTML = "Mensagem enviada!";
            statusForm.style.color = "green";
            form.reset();
            // Altera o texto do botão para "Enviado!"
            btnSubmit.textContent = "Enviado!";
        } else {
            // Se o Formspree retornou um erro (ex: validação falhou)
            response.json().then(data => {
                if (Object.hasOwn(data, 'errors')) {
                    statusForm.innerHTML = data["errors"].map(error => error["message"]).json(", ");
                } else {
                    statusForm.innerHTML = "Ocorreu um erro ao enviar sua mensagem.";
                }
                statusForm.style.color = "red";
                // Reativa o botão para o usuário tentar de novo
                btnSubmit.setAttribute('disabled', 'false');
                btnSubmit.textContent = "Tentar Novamente";
            })
        }
    }).catch(error => {
        // Se ocorreu um erro de rede
        statusForm.innerHTML = "Ocorreu um erro de rede. Tente novamente.";
        statusForm.style.color = "red";
        // Reativa o botão
        btnSubmit.setAttribute('disabled', 'false');
        btnSubmit.textContent = "Tentar Novamente";
    })
}
// Adiciona o "ouvinte" de evento ao formulário
form.addEventListener("submit", handleSubmit);

