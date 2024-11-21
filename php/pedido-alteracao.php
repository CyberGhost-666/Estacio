<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_curso = $_POST['id_curso'] ?? null;
        $id_materia = $_POST['id_materia'] ?? null;
        $id_usuario = $_POST['id_usuario'] ?? null;
        $ara = trim($_POST['ara'] ?? '');
        $sala = trim($_POST['sala'] ?? '');
        $turno = $_POST['turno'] ?? null;
        $dia_semana = $_POST['dia_semana'] ?? null;

        if (!$id_curso || !$id_materia || !$id_usuario || !$ara || !$sala || !$turno || !$dia_semana) {
            echo "Todos os campos são obrigatórios!";
            exit;
        }

        try {
            $stmt = $pdo->prepare("
                INSERT INTO pedido_alteracao (id_curso, id_materia, id_usuario, ara, sala, turno, dia_semana)
                VALUES (:ic, :im, :iu, :a, :s, :t, :ds)
            ");

            $stmt->bindParam(':ic', $id_curso, PDO::PARAM_INT);
            $stmt->bindParam(':im', $id_materia, PDO::PARAM_INT);
            $stmt->bindParam(':iu', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':a', $ara, PDO::PARAM_STR);
            $stmt->bindParam(':s', $sala, PDO::PARAM_STR);
            $stmt->bindParam(':t', $turno, PDO::PARAM_STR);
            $stmt->bindParam(':ds', $dia_semana, PDO::PARAM_STR);

            $stmt->execute();

            header("Location: ../pages/index-professor.php?success=1");
            exit;
        } catch (PDOException $e) {
            echo "Erro ao inserir pedido de alteração: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Método de requisição inválido.";
        exit;
    }
?>