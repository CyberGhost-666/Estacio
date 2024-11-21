<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];

        if (empty($nome)) {
            echo "Insira o Nome do Curso!";
            exit;
        }

        $sqlCheck = "SELECT * FROM curso WHERE nome = :n";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':n', $nome);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            echo "Este Curso já Está Cadastrado!";
            exit;
        }

        $sql = "INSERT INTO curso (nome) VALUES (:n)";
        $sql = $pdo->prepare($sql);
        $sql->bindParam(':n', $nome);

        if ($sql->execute()) {
            header('Location: ../pages/cadastrar-horario-admin.php');
            exit;
        }
        else {
            echo "Erro ao Cadastrar Curso";
        }
    }
?>