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


/* Formulário */

// Seleciona o formulário, o botão de envio e o status
var form = document.getElementById('form');
var btnSubmit = document.getElementById('btnSubmit');
var statusForm = document.getElementById('statusForm');

// Função para lidar com o envio do formulário
async function handleSubmit(event) {
    // 1. Previne o comportamento padrão (recarregar a página)
    event.preventDefault();

    // 2. Prepara a UI para o envio
    statusForm.textContent = '';
    statusForm.style.display = 'none';
    btnSubmit.disabled = true;
    btnSubmit.textContent = "Enviando...";

    try {
        // 3. Envia os dados para o seu script PHP
        const response = await fetch(event.target.action, {
            method: form.method,
            body: new FormData(event.target),
            headers: {
                'Accept': 'application/json'
            }
        });

        // 4. Espera e interpreta a resposta JSON do PHP
        const data = await response.json();

        // 5. Verifica se a resposta foi bem-sucedida
        if (response.ok) {
            // Cenário De Sucesso
            statusForm.textContent = data.message;
            statusForm.style.color = "green";
            form.reset();
            btnSubmit.textContent = "Enviado!";

        } else {
            // Cenário De Erro Do Servidor 
            throw new Error(data.message || 'Ocorreu um erro no servidor.');
        }

    } catch (error) {
        // Cenário De Erro De Rede Ou Erro Lançado
        statusForm.textContent = error.message;
        statusForm.style.color = "red";

        setTimeout(() => {
            btnSubmit.disabled = false;
            btnSubmit.textContent = "Tentar Novamente";
        }, 1500); // Delay de 2 segundos

    } finally {
        // Garante que a caixa de status sempre apareça após a tentativa
        statusForm.style.display = 'block';
    }
}

// Ouvinte de evento do formulário 
if (form) {
    form.addEventListener("submit", handleSubmit);
}
