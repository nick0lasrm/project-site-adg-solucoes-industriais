<?php

// ===== CONFIGURAÇÕES E PRÉ-REQUISITOS =====

// Silencia erros na tela em produção, mas loga-os para depuração
ini_set('display_errors', 1);
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

//  COLETA E VALIDAÇÃO DOS DADOS DO FORMULÁRIO 
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

// ENVIO DO E-MAIL COM PHPMailer

$mail = new PHPMailer(true);

try {
    // CONFIGURAÇÕES DO SERVIDOR SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'nickolasraphael3232@gmail.com';
    $mail->Password   = 'tbltxmxakhjozyqk';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;                        
    $mail->CharSet    = 'UTF-8';

    // REMETENTE E DESTINATÁRIOS 
    $mail->setFrom('administrativo@adgsolucoesindustriais.com.br', 'ADG Soluções Industriais'); // Quem está enviando
    $mail->addAddress('nickolasraphael3232@gmail.com'); // Para quem o e-mail será enviado
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