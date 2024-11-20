<?php
    require_once '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['usuario'])) {
        $usuario = $_POST['usuario'];

        try {
            $sql = "DELETE FROM usuario WHERE usuario = :u";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':u', $usuario, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: ../pages/usuarios-admin.php?message=Usuário Deletado!");
            exit;
        }
        catch (PDOException $e) {
            die("Erro ao Deletar Usuário: " . $e->getMessage());
        }
    }
    else {
        header("Location: ../pages/usuarios-admin.php");
        exit;
    }
?>