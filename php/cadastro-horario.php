<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_curso = $_POST['curso'];
        $id_materia = $_POST['materia'];
        $id_usuario = $_POST['professor'];
        $ara = $_POST['ara'];
        $sala = $_POST['sala'];
        $turno = $_POST['turno'];
        $dia_semana = $_POST['diaSemana'];

        if (empty($id_curso) || empty($id_materia) || empty($id_usuario) || empty($ara) || empty($sala) || empty($turno) || empty($dia_semana)) {
            echo "Todos os Campos São Obrigatórios";
            exit;
        }

        $sqlCheck = "SELECT * FROM horario WHERE id_curso = :ic AND id_materia = :im AND id_usuario = :iu AND turno = :t AND dia_semana = :ds";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':ic', $id_curso);
        $stmtCheck->bindParam(':im', $id_materia);
        $stmtCheck->bindParam(':iu', $id_usuario);
        $stmtCheck->bindParam(':t', $turno);
        $stmtCheck->bindParam(':ds', $dia_semana);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            echo "Já Existe um Horário Cadastrado Para Esse Curso, Matéria, Professor, Turno e Dia da Semana!";
            exit;
        }

        $sql = "INSERT INTO horario (ara, sala, turno, dia_semana, id_curso, id_materia, id_usuario) VALUES (:a, :s, :t, :ds, :ic, :im, :iu)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':a', $ara);
        $stmt->bindParam(':s', $sala);
        $stmt->bindParam(':t', $turno);
        $stmt->bindParam(':ds', $dia_semana);
        $stmt->bindParam(':ic', $id_curso);
        $stmt->bindParam(':im', $id_materia);
        $stmt->bindParam(':iu', $id_usuario);

        if ($stmt->execute()) {
            header('Location: ../pages/horarios.html');
            exit;
        }
        else {
            echo "Erro ao Cadastrar Horário!";
        }
    }
?>