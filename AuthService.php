<?php
require_once 'usuario.php';
require_once 'usuarioDAO.php';

$type = filter_input(INPUT_POST, "type");

if ($type === "register") {
    //cadastro de Usuario
    //recebimento de dados vindo do input do html
    $new_nome = filter_input(INPUT_POST, "new_nome");
    $new_email = filter_input(INPUT_POST, "new_email", FILTER_SANITIZE_EMAIL);
    $new_password = filter_input(INPUT_POST, "new_password");
    $confirm_password = filter_input(INPUT_POST, "confirm_password");

    //verificação dos dados informados
    if ($new_email && $new_nome && $new_password) {
        if ($new_password === $confirm_password) {
            //etapa de segurança:
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(25));
            // criação do usuario no banco de dados;
            $usuario = new Usuario(null, $new_nome, $hashed_password, $new_email, $token);

            $usuarioDAO = new usuarioDAO();
            $succes = $usuarioDAO->create($usuario);

            if ($succes) {
                $_SESSION['token'] = $token;
                header('Location: index.php');
            } else {
                echo 'ERRO AO REGISTRAR BANCO DE DADOS';
                exit();
            }
        } else {
            echo 'senha incompativel!';
        }
    } else {
        echo "Dados de input inválidos!";
        exit();
    }
} elseif ($type === "login") {
    //login de usuario
}
