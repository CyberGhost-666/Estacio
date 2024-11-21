<?php
    require '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_curso = $_POST['curso'];
        $materia = $_POST['materia'];

        if (empty($id_curso)) {
            echo "Selecione o Curso!";
            exit;
        }

        if (empty($materia)) {
            echo "O Nome da Matéria é Obrigatório!";
            exit;
        }

        $sqlCheck = "SELECT * FROM materia WHERE nome = :n AND id_curso = :ic;;";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':n', $materia);
        $stmtCheck->bindParam(':ic', $id_curso);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            echo "Essa Matéria já Está Cadastrada Para Esse Curso!";
            exit;
        }

        $sql = "INSERT INTO materia (nome, id_curso) VALUES (:n, :ic)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':n', $materia);
        $stmt->bindParam(':ic', $id_curso);

        if ($stmt->execute()) {
            header('Location: ../pages/cadastrar-horario-admin.php');
            exit;
        }
        else {
            echo "Erro ao Cadastrar Matéria!";
        }
    }
?>