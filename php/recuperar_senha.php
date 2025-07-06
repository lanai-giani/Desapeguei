<?php
require_once __DIR__ . '/../conexao.php';

require '../php/PHPMailer/src/PHPMailer.php';
require '../php/PHPMailer/src/SMTP.php';
require '../php/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    try {
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $token = bin2hex(random_bytes(32));
            $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $update = $pdo->prepare("UPDATE usuarios SET reset_token = ?, reset_expira = ? WHERE email = ?");
            $update->execute([$token, $expira, $email]);

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'lanaigiani10@gmail.com'; 
                $mail->Password = 'ncij xfsp hmza wwba'; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('lanaigiani10@gmail.com', 'Desapeguei');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Recuperação de senha';
                $link = "http://localhost/desapeguei/nova_senha.html?token=$token";
                $mail->Body = "Olá!<br><br>Para redefinir sua senha no nosso site, clique no link:<br><br><a href='$link'>$link</a>";

                $mail->send();

                header("Location: ../recuperar_sucesso.html");
                exit();
            } catch (Exception $e) {
                error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
                header("Location: ../recuperar_senha.html?erro=envio_falhou");
                exit();
            }
        } else {
            header("Location: ../recuperar_senha.html?erro=email_nao_encontrado");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Erro no banco: " . $e->getMessage());
        header("Location: ../recuperar_senha.html?erro=erro_banco");
        exit();
    }
}
?>
