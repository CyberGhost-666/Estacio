<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $confSenha = $_POST['confSenha'];
        $tipoUsuario = $_POST['tipoUsuario'];

        if ($senha !== $confSenha) {
            echo "<script>alert('As Senhas Não Coincidem!'); window.location.href = '../pages/cadastrar-usuario-admin.php';</script>";
            exit;
        }

        if (empty($usuario)) {
            echo "<script>alert('O Campo 'Usuário' é Obrigatório!'); window.location.href = '../pages/cadastrar-usuario-admin.php';</script>";
            exit;
        }

        $sqlCheck = "SELECT * FROM usuario WHERE usuario = :u";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':u', $usuario);
        $stmtCheck->execute();
        if ($stmtCheck->rowCount() > 0) {
            echo "<script>alert('Este Usuário Já Está Cadastrado!'); window.location.href = '../pages/cadastrar-usuario-admin.php';</script>";
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
            echo "<script>alert('Cadastro Realizado Com Sucesso!'); window.location.href = '../pages/usuarios-admin.php';</script>";
            exit;
        }
        else {
            echo "<script>alert('Erro ao Cadastrar Usuário'); window.location.href = '../pages/usuarios-admin.php';</script>";
        }
    }
?>