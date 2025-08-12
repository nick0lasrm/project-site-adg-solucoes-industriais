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


/* Dropmenu e Dropmenu-Mobile */


// Seleciona o dropmenu
const dropmenu = document.getElementById('dropmenu')

// Evento que abre o dropmenu quando entra no elemento ou em qualquer um de seus elementos filhos
dropmenu.addEventListener('mouseover', () => {
    document.getElementById('menu-items').classList.add('expand-dropmenu')
    document.querySelector('.caret-icon-desktop').classList.add('rotate-up')
})

// Evento que fecha o dropmenu quando o cursor do mouse deixa o elemento ou qualquer um de seus elementos filhos
dropmenu.addEventListener('mouseout', () => {
    document.getElementById('menu-items').classList.remove('expand-dropmenu')
    document.querySelector('.caret-icon-desktop').classList.remove('rotate-up')
})


const dropmenu_mobile = document.getElementById('dropmenu-mobile')
dropmenu_mobile.addEventListener('click', () => {
    document.getElementById('menu-items-mobile').classList.toggle('expand-dropmenu')
    document.querySelector('.caret-icon-mobile').classList.toggle('rotate-up')
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

// Lógica Do Contador De Caracteres

// 1. Espera o conteúdo da página carregar completamente
document.addEventListener('DOMContentLoaded', () => {

    // 2. Seleciona os elementos do contador
    const mensagemTextarea = document.getElementById('mensagem');
    const caracteresAtuaisEl = document.getElementById('caracteresAtuais');
    const caracteresMaximosEl = document.getElementById('caracteresMaximos');
    const contadorContainer = document.getElementById('contadorContainer');

    // Garante que o código só rode se os elementos existirem na página
    if (mensagemTextarea && caracteresAtuaisEl && caracteresMaximosEl) {

        // 3. Pega o limite máximo definido no atributo 'maxlength' do HTML
        const limiteMaximo = mensagemTextarea.getAttribute('maxlength');
        caracteresMaximosEl.textContent = limiteMaximo; // Atualiza o número máximo na tela

        // 4. Adiciona um "ouvinte" de evento. O evento 'input' dispara a cada letra digitada.
        mensagemTextarea.addEventListener('input', () => {
            // Pega a quantidade de caracteres que o usuário já digitou
            const contagemAtual = mensagemTextarea.value.length;

            // Atualiza o texto do contador com o número atual
            caracteresAtuaisEl.textContent = contagemAtual;

            // Muda a cor quando se aproxima do limite
            if (contagemAtual > limiteMaximo * 0.9) { // Se passar de 90% do limite
                contadorContainer.style.color = '#c21b1b'; // Vermelho
            } else if (contagemAtual > limiteMaximo * 0.75) { // Se passar de 75%
                contadorContainer.style.color = '#c06161'; // Laranja
            } else {
                contadorContainer.style.color = '#636363'; // Cor cinza padrão
            }
        });
    }
});
