<?php
// Ativar a exibição de erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email']; // Corrigido de 'e-mail' para 'email'
    $telefone = $_POST['telefone'];
    $mensagem = $_POST['mensagem'];
    $email_destino = 'contato@lafaiat.com';

    // Definindo a variável boundary
    $boundary = md5(time());

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"_1_$boundary\"";

    $corpo = "--_1_$boundary\r\n";
    $corpo .= "Content-Type: text/plain; charset='utf-8'\r\n";
    $corpo .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $corpo .= "Nome: $nome\r\nEmail: $email\r\nTelefone: $telefone\r\nMensagem: $mensagem\r\n";

    // Anexo
    if (isset($_FILES['curriculo']) && $_FILES['curriculo']['error'] == UPLOAD_ERR_OK) {
        $curriculo = $_FILES['curriculo'];

        $fp = fopen($curriculo['tmp_name'], "rb");
        $anexo = fread($fp, filesize($curriculo['tmp_name']));
        $anexo = base64_encode($anexo);
        fclose($fp);
        $anexo = chunk_split($anexo);

        $corpo .= "--_1_$boundary\r\n";
        $corpo .= "Content-Type: ".$curriculo['type']."; name=\"".$curriculo['name']."\"\r\n";
        $corpo .= "Content-Disposition: attachment; filename=\"".$curriculo['name']."\"\r\n";
        $corpo .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $corpo .= "$anexo\r\n";
        $corpo .= "--_1_$boundary--\r\n";
    }

    // Enviar e-mail
    $enviado = mail($email_destino, "Candidatura Recebida", $corpo, $headers);

    if ($enviado) {
        echo "Candidatura enviada com sucesso!";
    } else {
        echo "Erro ao enviar a candidatura.";
    }
}
?>
