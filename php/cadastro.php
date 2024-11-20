<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $confSenha = $_POST['confSenha'];
        $tipoUsuario = $_POST['tipoUsuario'];

        if ($senha !== $confSenha) {
            echo "As Senhas Não Coincidem!";
            exit;
        }

        if (empty($usuario)) {
            echo 'O Campo "Usuário" é Obrigatório!';
            exit;
        }

        $sqlCheck = "SELECT * FROM usuario WHERE usuario = :u";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':u', $usuario);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() > 0) {
            echo "Este Usuário Já Está Cadastrado!";
            exit;
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (nome, usuario, senha, tipo_usuario) VALUES (:n, :u, :s, :tu)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':n', $nome);
        $stmt->bindParam(':u', $usuario);
        $stmt->bindParam(':s', $senhaHash);
        $stmt->bindParam(':tu', $tipoUsuario);

        if ($stmt->execute()) {
            echo "Cadastro Realizado Com Sucesso!";
            exit;
        }
        else {
            echo "Erro ao Cadastrar Usuário";
        }
    }
?>