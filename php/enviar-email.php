<?php

// Configurações E Pré-Requisitos

// Silencia erros na tela em produção, mas loga-os para depuração
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Importa as classes do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Carrega o autoloader do Composer.
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Define o cabeçalho de resposta como JSON
header('Content-Type: application/json');

// Função auxiliar para enviar a resposta JSON e terminar o script
function send_json_response($status, $message, $http_code = 200) {
    http_response_code($http_code);
    echo json_encode(['status' => $status, 'message' => $message]);
    exit;
}

// Validação Inicial

// 1. Verifica se a requisição foi feita usando o método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    send_json_response('error', 'Método não permitido.', 405);
}

//  Coleta E Validação Dos Dados Do Formulário

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');


// Formata o nome para "Title Case"
$nomeFormatado = mb_convert_case(mb_strtolower($nome, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');

// Formata a mensagem para ter apenas a primeira letra maiúscula
$mensagemFormatada = ucfirst(mb_strtolower($mensagem, 'UTF-8'));

// Validação dos campos obrigatórios
if (empty($nome) || empty($email) || empty($mensagem)) {
    send_json_response('error', 'Por favor, preencha todos os campos obrigatórios.', 400);
}

// Validação do formato do e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send_json_response('error', 'O formato do e-mail é inválido.', 400);
}

// Validação do comprimento mínimo do nome
if (strlen($nome) <= 2){
    send_json_response('error', 'Por favor informe seu primeiro nome ou completo.',400);
}

if (strlen($mensagem) > 3000) {
    send_json_response('error', 'Sua mensagem excedeu o limite (3000) de caracteres.',400);
}

// Validação do formato de telefone
if (!empty($telefone) && !preg_match('/^[0-9\s\-\(\)]+$/', $telefone)) {
    send_json_response('error', 'O formato de telefone parece inválido', 400);
}


// Envio Do E-Mail Com PHPMailer

$mail = new PHPMailer(true);

try {
    // Configurações Do Servidor SMTP
    $mail->isSMTP();
    $mail->Host       = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['SMTP_USER'];
    $mail->Password   = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $_ENV['SMTP_PORT'];                        
    $mail->CharSet    = 'UTF-8';

    // Remetente E Destinatários 
    $mail->setFrom($_ENV['SMTP_USER'], 'ADG Soluções Industriais'); // Quem está enviando
    $mail->addAddress($_ENV['MAIL_TO'], 'Setor de vendas'); // Para quem o e-mail será enviado
    $mail->addReplyTo($email, $nomeFormatado); // Faz o botão "Responder para" ir para o e-mail do cliente

    // Conteúdo Do E-Mail
    $mail->isHTML(true);
    $mail->Subject = '[Contato Site ADG] Nova mensagem de: ' . htmlspecialchars($nomeFormatado);
    
    // Monta um corpo de e-mail bem formatado
    $mail->Body = "
        <html>
        <head><style>body { font-family: sans-serif; } p { margin-bottom: 10px; }</style></head>
        <body>
            <h2 style='color: #333;'>Nova mensagem recebida pelo site: ADG Soluções Industriais</h2>
            <p><strong>Nome:</strong> " . htmlspecialchars($nomeFormatado) . "</p>
            <p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Telefone:</strong> " . (empty($telefone) ? 'Não informado' : htmlspecialchars($telefone)) . "</p>
            <p><strong>Mensagem:</strong></p>
            <p style='padding: 10px; border-left: 3px solid #ccc;'>" . nl2br(htmlspecialchars($mensagemFormatada)) . "</p>
            <hr>
            <p><small>Enviado em " . date('d/m/Y H:i:s') . ".</small></p>
        </body>
        </html>
    ";
    
    // Versão em texto plano para clientes de e-mail que não suportam HTML
    $mail->AltBody = "Nome: " . $nomeFormatado . "\nE-mail: " . $email . "\nTelefone: " . $telefone . "\n\nMensagem:\n" . $mensagemFormatada;

    $mail->send();

    // Se o e-mail foi enviado, retorna a resposta de sucesso para o JS
    send_json_response('success', 'Mensagem enviada!');

} catch (Exception $e) {
    // Em caso de erro no PHPMailer, loga o erro real para ver
    error_log("Erro no PHPMailer: " . $mail->ErrorInfo);
    // E envia uma mensagem genérica para o usuário
    send_json_response('error', 'Ocorreu um erro interno no servidor ao tentar enviar a mensagem.', 500);
}
