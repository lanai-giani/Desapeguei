<?php
session_start();
require_once 'conexao.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id_token'])) {
    echo json_encode(['success' => false, 'message' => 'Token não recebido']);
    exit;
}

$token = $data['id_token'];

// Valida token na API do Google
$google_api_url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;

$response = file_get_contents($google_api_url);
if ($response === false) {
    echo json_encode(['success' => false, 'message' => 'Erro ao validar token']);
    exit;
}

$payload = json_decode($response, true);

// Verifica se token é válido
if (isset($payload['aud']) && $payload['aud'] === '914623445866-fcn65judhjk3hpvmsr0789l9r3b2qvii.apps.googleusercontent.com') {
    $email = $payload['email'];
    $nome = $payload['name'] ?? '';
    $google_id = $payload['sub'];

    // Procura usuário no banco
    $stmt = $pdo->prepare("SELECT id, nome, email, apelido FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario) {
        // Se não existe usuário, você pode criar automático ou retornar erro para cadastro
        // Aqui vamos criar automaticamente
        $stmtInsert = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, apelido) VALUES (?, ?, '', ?)");
        $apelido = strtok($nome, ' '); // pega o primeiro nome como apelido
        $stmtInsert->execute([$nome, $email, $apelido]);

        $usuario_id = $pdo->lastInsertId();

        $_SESSION['usuario'] = [
            'id' => $usuario_id,
            'nome' => $nome,
            'apelido' => $apelido,
            'email' => $email
        ];

    } else {
        // Usuário existe, loga normalmente
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'apelido' => $usuario['apelido'],
            'email' => $usuario['email']
        ];
    }

    echo json_encode(['success' => true]);

} else {
    echo json_encode(['success' => false, 'message' => 'Token inválido']);
}
?>
