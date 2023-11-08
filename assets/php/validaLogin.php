<?php 
session_start();
require '../../assets/php/conexao.php';
$conn = conectarAoBanco();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM cadastro WHERE email = ? AND senha = ?";
    
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Falha na preparação da declaração: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $senha);

    if ($stmt->execute()) {
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();
            
            $_SESSION['user_id'] = $row['id']; 

            header("Location: ../../views/autenticado/home.php");
            exit();
            
        } else {
          
            echo "Usuário ou senha incorretos!";
            sleep(3); 
            header("Location:../../views/public/login.php");
            exit();
        }
        
    } else {
        echo "Erro ao buscar no banco de dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>