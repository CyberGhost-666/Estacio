<?php
    require_once '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_horario = intval($_POST['id_horario']);
        $ara = trim($_POST['ara']);
        $sala = trim($_POST['sala']);
        $turno = $_POST['turno'];
        $dia_semana = $_POST['dia_semana'];
        $id_curso = intval($_POST['id_curso']);
        $id_materia = intval($_POST['id_materia']);
        $id_usuario = intval($_POST['id_usuario']);

        try {
            $sql = "UPDATE horario 
                    SET ara = :a, sala = :s, turno = :t, dia_semana = :ds, 
                        id_curso = :ic, id_materia = :im, id_usuario = :iu 
                    WHERE id_horario = :ih";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':a', $ara);
            $stmt->bindParam(':s', $sala);
            $stmt->bindParam(':t', $turno);
            $stmt->bindParam(':ds', $dia_semana);
            $stmt->bindParam(':ic', $id_curso, PDO::PARAM_INT);
            $stmt->bindParam(':im', $id_materia, PDO::PARAM_INT);
            $stmt->bindParam(':iu', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':ih', $id_horario, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: ../pages/horarios.php?status=editado");
            exit();
        } catch (PDOException $e) {
            die("Erro ao salvar alterações: " . $e->getMessage());
        }
    } else {
        header("Location: ../pages/horarios.php?status=erro");
        exit();
    }
?>