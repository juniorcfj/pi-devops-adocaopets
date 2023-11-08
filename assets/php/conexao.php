<?php

function conectarAoBanco() {
    
    $conn = mysqli_connect('localhost', 'root', '', 'adocaopets');
   
    if (!$conn) {
        die('Erro de conexão: ' . mysqli_connect_error());
    }

    return $conn;

}
?>
