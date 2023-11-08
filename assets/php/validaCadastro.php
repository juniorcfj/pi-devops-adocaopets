<?php 
require '../../assets/php/conexao.php';
$conn = conectarAoBanco();


$email = $_POST['email'];
$sql = "SELECT id FROM cadastro WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<div class='cadastrado'>E-mail já cadastrado!<button class='btn-cadastrado' onclick='window.history.back()'>Voltar</button></div>";
    echo "";
} else {
    
    $sql = "INSERT INTO cadastro (nome, email, senha, whatsapp)
            VALUES (?, ?, ?, ?)";

   
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Falha na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ssss", $nome, $email, $senha, $whatsapp);

    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $whatsapp = $_POST['whatsapp'];

 
    if ($stmt->execute()) {

        echo "<script>setTimeout(function(){window.location.href='../../views/public/login.php';}, 3000);</script>";
        echo "<div class='success'>Obrigado por se cadastrar na nossa plataforma!</div>";
        echo "<div class='loader'></div>";
        echo "<div class='text'>Você será redirecionado para tela de login</div>";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Cadastro pet</title>

    <style>
        /* Seus estilos CSS aqui */
        .loader {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #613387;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
    margin: 20px auto;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.success {
    font-size:30px;
    color: #613387;
    padding: 10px;
    margin: 20px 0;
    text-align: center;
    margin-top:200px;
    font-weight:600;
    font-family:Roboto;
}

.text{
    font-size:30px;
    color: #613387;
    padding: 10px;
    margin: 20px 0;
    text-align: center;
    margin-top:20px;
    font-weight:600;
    font-family:Roboto;
}

    </style>
</head>
<body>
</body>
</html>