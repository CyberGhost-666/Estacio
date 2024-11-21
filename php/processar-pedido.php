<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_pedido = $_POST['id_pedido'] ?? null;
        $acao = $_POST['acao'] ?? null;

        if (!$id_pedido || !$acao) {
            echo "Pedido inválido.";
            exit;
        }

        try {
            if ($acao === 'aceitar') {
                $stmt = $pdo->prepare("DELETE FROM pedido_alteracao WHERE id_pedido_alteracao = :id_pedido");
                $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmt->execute();
                echo "Pedido aceito!";
            }
            elseif ($acao === 'rejeitar') {
                $stmt = $pdo->prepare("DELETE FROM pedido_alteracao WHERE id_pedido_alteracao = :id_pedido");
                $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmt->execute();
                echo "Pedido rejeitado!";
            }
        }
        catch (PDOException $e) {
            echo "Erro ao processar pedido: " . $e->getMessage();
        }
    }
    else {
        echo "Método de requisição inválido.";
    }
?>