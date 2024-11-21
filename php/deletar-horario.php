<?php
    require_once '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_horario'])) {
        $id_horario = intval($_POST['id_horario']);

        try {
            $sql = "DELETE FROM horario WHERE id_horario = :ih";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ih', $id_horario, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                header("Location: ../pages/horarios.php?status='sucesso'");
                exit();
            }
            else {
                header("Location: ../pages/horarios.php?status='erro'");
                exit();
            }
        }
        catch (PDOException $e) {
            die("Erro ao Deletar Horário: " . $e->getMessage());
        }
    }
?>