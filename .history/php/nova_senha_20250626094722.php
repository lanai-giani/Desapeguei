<?php
require_once __DIR__ . '/../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if (empty($token) || empty($senha) || empty($confirmarSenha)) {
        header("Location: ../nova_senha.html?erro=campos_vazios&token=$token");
        exit();
    }

    if ($senha !== $confirmarSenha) {
        header("Location: ../nova_senha.html?erro=senhas_nao_coincidem&token=$token");
        exit();
    }

    // Regras mínimas de senha 
    if (strlen($senha) < 8 || !preg_match('/[a-zA-Z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
        header("Location: ../nova_senha.html?erro=senha_fraca&token=$token");
        exit();
    }

    try {
        // Verifica se o token é válido
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE reset_token = ? AND reset_expira > NOW()");
        $stmt->execute([$token]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            header("Location: ../nova_senha.html?erro=token_invalido");
            exit();
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $update = $pdo->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_expira = NULL WHERE id = ?");
        $update->execute([$senhaHash, $usuario['id']]);

        header("Location: ../login.html?senha_alterada=1");
        exit();

    } catch (PDOException $e) {
        error_log("Erro no banco: " . $e->getMessage());
        header("Location: ../nova_senha.html?erro=erro_banco&token=$token");
        exit();
    }
}
?>
