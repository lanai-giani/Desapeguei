<?php
session_start();
require_once 'conexao.php';

$erro = '';

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos.';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, nome, email, senha, apelido FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch();

            if (!$usuario) {
                $erro = 'Email não encontrado.';
            } elseif (!password_verify($senha, $usuario['senha'])) {
                $erro = 'Senha incorreta. Tente novamente.';
            } else {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'apelido' => $usuario['apelido'],
                    'email' => $usuario['email']
                ];
                header("Location: ../index.php");
                exit();
            }
        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $erro = 'Erro no servidor. Tente novamente mais tarde.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar | desapeguei</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="pagina-login">
    <div class="navbar">
        <div class="logo">
            <a href="../index.php"> 
                <img src="../assets/img/logoTeste.png" alt="desapeguei" width="130px">
            </a>
        </div>
    </div>

    <div class="login-container">
        <div class="login-box">
            <h1>Entrar</h1>

            <?php if (!empty($erro)): ?>
                <div id="erro-mensagem"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form id="formLogin" action="" method="POST">
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn">Acessar</button>

                <div class="google-btn">
                    <div id="g_id_onload"
                        data-client_id="914623445866-fcn65judhjk3hpvmsr0789l9r3b2qvii.apps.googleusercontent.com"
                        data-callback="handleGoogleLogin">
                    </div>
                    <div class="g_id_signin"
                        data-type="standard"
                        data-theme="filled_blue"
                        data-text="continue_with"
                        data-shape="rectangular">
                    </div>
                </div>
            </form>

            <p class="login-link">Não tem uma conta? <a href="cadastro.html">Cadastre-se</a></p>
            <div class="login-link">
                <a href="recuperar_senha.html">Esqueceu a senha?</a>
            </div>
        </div>
    </div>

    <script src="../assets/js/app.js"></script>
    <script>
  async function handleGoogleLogin(response) {
    const data = {
      id_token: response.credential
    };

    try {
      const res = await fetch('../php/google_login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });

      const result = await res.json();

      if (result.success) {
        window.location.href = '../index.php';
      } else {
        alert('Erro no login com Google: ' + result.message);
      }
    } catch (e) {
      console.error('Erro na requisição:', e);
      alert('Erro na comunicação com o servidor.');
    }
  }
</script>
</body>
</html>
