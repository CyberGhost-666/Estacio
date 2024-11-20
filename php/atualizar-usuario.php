<?php
    require_once '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['usuario'])) {
        $usuario = $_POST['usuario'];
        $nome = $_POST['nome'];
        $tipoUsuario = $_POST['tipoUsuario'];

        try {
            $sql = "UPDATE usuario SET nome = :n, tipo_usuario = :tu WHERE usuario = :u";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':n', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':tu', $tipoUsuario, PDO::PARAM_STR);
            $stmt->bindParam(':u', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: ../pages/usuarios-admin.php?message=Usuário Atualizado!");
            exit();
        }
        catch (PDOException $e) {
            die("Erro ao Atualizar Usuário: " . $e->getMessage());
        }
    }
    else {
        header("Location: ../pages/usuarios-admin.php");
        exit();
    }
?>