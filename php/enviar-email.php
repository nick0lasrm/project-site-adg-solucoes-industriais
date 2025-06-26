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

// ===== COLETA E VALIDAÇÃO DOS DADOS DO FORMULÁRIO =====

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

// Validação dos campos obrigatórios
if (empty($nome) || empty($email) || empty($mensagem)) {
    send_json_response('error', 'Por favor, preencha todos os campos obrigatórios.', 400);
}

// Validação do formato do e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    send_json_response('error', 'O formato do e-mail é inválido.', 400);
}

// Envio Do E-Mail Com PHPMailer

$mail = new PHPMailer(true);

try {
    // Configurações Do Servidor Smtp
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
    $mail->addAddress($_ENV['MAIL_TO']); // Para quem o e-mail será enviado
    $mail->addReplyTo($email, $nome); // Faz o botão "Responder" ir para o e-mail do cliente

    // Conteúdo Do E-Mail
    $mail->isHTML(true);
    $mail->Subject = 'Nova Mensagem do Site - ADG' . htmlspecialchars($nome);
    
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

    // Se o e-mail foi enviado, retorna a resposta de sucesso para o JS
    send_json_response('success', 'Mensagem enviada com sucesso!');

} catch (Exception $e) {
    // Em caso de erro no PHPMailer, loga o erro real para ver
    error_log("Erro no PHPMailer: " . $mail->ErrorInfo);
    // E envia uma mensagem genérica para o usuário
    send_json_response('error', 'Ocorreu um erro interno no servidor ao tentar enviar a mensagem.', 500);
}
