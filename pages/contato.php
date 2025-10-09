<?php include('../components/header.php');
?>

<section id="contato" class="background bg-2">

    <div class="container px-3 px-sm-5 py-5">
        <div class="text-center mb-5">
            <h2 class="fs2r c-red fw-bold text-uppercase mb-4">
                Fale Conosco
            </h2>
            <p class="c-white2">
                Tem alguma dúvida ou gostaria de solicitar um orçamento? Envie sua mensagem.
            </p>
        </div>

        <form action="php/enviar-email.php" method="POST" class="col-lg-8 mx-auto" id="form">

            <div class="mb-3">
                <label for="nome" class="form-label c-white2">
                    Nome
                </label>
                <input type="text" class="form-control border-3 rounded-1" id="nome" name="nome"
                    placeholder="Digite seu nome" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label c-white2">
                    E-mail
                </label>
                <input type="email" class="form-control border-3 rounded-1" id="email" name="email"
                    placeholder="seu.email@exemplo.com" required>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label c-white2">
                    Telefone (Opcional)
                </label>
                <input type="tel" class="form-control border-3 rounded-1" id="telefone" name="telefone"
                    placeholder="(00) 00000-0000">
            </div>

            <div class="mb-3">
                <label for="mensagem" class="form-label c-white2">
                    Sua Mensagem
                </label>
                <textarea class="form-control border-3 rounded-1" id="mensagem" name="mensagem" rows="8"
                    placeholder="Digite sua dúvida ou solicitação aqui..." required maxlength="3000"></textarea>
                <div id="contadorContainer" style="text-align: right; font-size: 0.9em; color: #636363;">
                    <span id="caracteresAtuais">
                        0
                    </span>
                    /
                    <span id="caracteresMaximos">
                        3000
                    </span>
                </div>
            </div>

            <div class="text-center d-flex flex-column flex-sm-row gap-3 gap-">
                <button type="submit" id="btnSubmit"
                    class="btn-hover btn-animation text-decoration-none border-0 c-white1 fs-5 bg-red2 px-3 py-3 fw-bold rounded-1 align-self-start"
                    aria-label="Botão para enviar o e-mail">
                    Enviar Mensagem
                </button>
                <button id="btnSubmitWhatsapp" type="button" onclick="btnSubmitWhatsapp()"
                    class="btn-animation text-decoration-none border-0 c-white1 fs-5 bg-red2 px-3 py-3 fw-bold rounded-1 d-inline-flex align-self-start align-items-center gap-2"
                    aria-label="Botão para enviar a mensagem via whatsapp">
                    Enviar Via Whatsapp
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                    </svg>
                </button>
            </div>
            <p id="statusForm" class="text-center">

            </p>

            <div>

            </div>
        </form>
    </div>
</section>

<?php include('../components/footer.php');
?>