<?php

// ===== CONFIGURAÇÕES E PRÉ-REQUISITOS =====

// Silencia erros na tela em produção, mas loga-os para depuração
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Importa as classes do PHPMailer para o escopo global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoloader do Composer.
// O caminho é '../vendor/autoload.php' porque este script está dentro da pasta /php
require __DIR__ . '/../vendor/autoload.php';

// Define o cabeçalho de resposta como JSON, pois é o que seu JavaScript espera
header('Content-Type: application/json');

// Função auxiliar para enviar a resposta JSON e terminar o script
function send_json_response($status, $message, $http_code = 200) {
    http_response_code($http_code);
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

// ===== VALIDAÇÃO INICIAL =====

// 1. Verifica se a requisição foi feita usando o método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_json_response('error', 'Método não permitido.', 405);
}

// ===== VERIFICAÇÃO reCAPTCHA =====

// Coloque aqui a sua Chave Secreta do reCAPTCHA
/* $recaptcha_secret = ''; 
$recaptcha_response = $_POST['g-recaptcha-response'];

if (empty($recaptcha_response)) {
    send_json_response('error', 'Por favor, marque a caixa "Não sou um robô".', 400);
}

// Monta e envia a requisição para a API do Google para verificar o token
$verify_url = 'https://www.google.com/recaptcha/api/siteverify';
$verify_data = http_build_query([
    'secret'   => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
]);
$options = ['http' => ['method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $verify_data]];
$context = stream_context_create($options);
$response_json = file_get_contents($verify_url, false, $context);
$response_data = json_decode($response_json);

if ($response_data === null || $response_data->success == false) {
    // Log do erro para depuração
    error_log("Falha na verificação do reCAPTCHA: " . $response_json);
    send_json_response('error', 'Falha na verificação do reCAPTCHA. Tente novamente.', 400);
} */

// ===== COLETA E VALIDAÇÃO DOS DADOS DO FORMULÁRIO =====

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? ''); // Opcional
$mensagem = trim($_POST['mensagem'] ?? '');

// Validação dos campos obrigatórios
if (empty($nome) || empty($email) || empty($mensagem)) {
    send_json_response('error', 'Por favor, preencha todos os campos obrigatórios.', 400);
}

// Validação do formato do e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send_json_response('error', 'O formato do e-mail é inválido.', 400);
}


// ===== ENVIO DO E-MAIL COM PHPMailer =====

$mail = new PHPMailer(true);

try {
    // -- CONFIGURAÇÕES DO SERVIDOR SMTP --
    // Substitua com as informações do seu provedor de e-mail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';      // Ex: smtp.gmail.com, smtp.hostinger.com
    $mail->SMTPAuth   = true;
    $mail->Username   = 'nickolasraphael3232@gmail.com'; // Seu e-mail completo
    $mail->Password   = '*Nr453251*';       // Sua senha
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // ou `PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port       = 465;                        // 465 para SMTPS, 587 para STARTTLS
    $mail->CharSet    = 'UTF-8';

    // -- REMETENTE E DESTINATÁRIOS --
    $mail->setFrom('administrativo@adgsolucoesindustriais.com.br', 'ADG Soluções Industriais'); // Quem está enviando
    $mail->addAddress('nickolasraphael3232@gmail.com', 'Nome da Empresa'); // Para quem o e-mail será enviado
    $mail->addReplyTo($email, $nome); // Faz o botão "Responder" ir para o e-mail do cliente

    // -- CONTEÚDO DO E-MAIL --
    $mail->isHTML(true);
    $mail->Subject = 'Nova Mensagem do Site - ADG Soluções Industriais ' . htmlspecialchars($nome);
    
    // Monta um corpo de e-mail bem formatado
    $mail->Body = "
        <html>
        <head><style>body { font-family: sans-serif; } p { margin-bottom: 10px; }</style></head>
        <body>
            <h2 style='color: #333;'>Nova mensagem recebida pelo site: ADG Soluções Industriais</h2>
            <p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>
            <p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Telefone:</strong> " . (empty($telefone) ? 'Não informado' : htmlspecialchars($telefone)) . "</p>
            <p><strong>Mensagem:</strong></p>
            <p style='padding: 10px; border-left: 3px solid #ccc;'>" . nl2br(htmlspecialchars($mensagem)) . "</p>
            <hr>
            <p><small>Enviado em " . date('d/m/Y H:i:s') . ".</small></p>
        </body>
        </html>
    ";
    
    // Versão em texto plano para clientes de e-mail que não suportam HTML
    $mail->AltBody = "Nome: " . $nome . "\nE-mail: " . $email . "\nTelefone: " . $telefone . "\n\nMensagem:\n" . $mensagem;

    $mail->send();
    // Se o e-mail foi enviado, retorna a resposta de sucesso que seu JS espera
    send_json_response('success', 'Mensagem enviada com sucesso!');

} catch (Exception $e) {
    // Em caso de erro no PHPMailer, loga o erro real para você ver
    error_log("Erro no PHPMailer: " . $mail->ErrorInfo);
    // E envia uma mensagem genérica para o usuário
    send_json_response('error', 'Ocorreu um erro interno no servidor ao tentar enviar a mensagem.', 500);
}
