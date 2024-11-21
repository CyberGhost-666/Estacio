<?php
    include '../php/config.php';

    try {
        $stmt = $pdo->query("
            SELECT 
                h.id_horario,
                h.ara,
                h.sala,
                c.nome AS curso,
                m.nome AS materia,
                u.nome AS professor
            FROM horario h
            JOIN curso c ON h.id_curso = c.id_curso
            JOIN materia m ON h.id_materia = m.id_materia
            JOIN usuario u ON h.id_usuario = u.id_usuario
            ORDER BY h.id_horario DESC
        ");

        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo "Erro ao buscar os horários: " . $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/estacio-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/menu.css">
    <link rel="stylesheet" href="../estilos/cards.css">
    <title>Centro Universitário Estácio de Sá - Admin</title>
</head>
<body>
    <header class="menu">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <nav class="menu-itens">
            <a href="../pages/index-admin.html">Home</a>
            <a href="../pages/usuarios-admin.php">Usuários</a>
            <a href="../pages/pedidos-admin.php">Pedidos</a>
            <a href="../pages/horarios.php">Horários</a>
        </nav>

        <div class="usuario-logado">
            <span>Bem-Vindo(a), <strong>Fred Lopes</strong></span>
        </div>
    </header>

    <main class="area-cards">
        <?php if (!empty($horarios)): ?>
            <?php foreach ($horarios as $horario): ?>
                <div class="card">
                    <h1><?= htmlspecialchars($horario['curso']) ?></h1>
                    <div class="line"></div>
                    <div class="info-card">
                        <div class="esquerda">
                            <h2><?= htmlspecialchars($horario['materia']) ?></h2>
                            <p>Professor(a): <?= htmlspecialchars($horario['professor']) ?></p>
                            <p>ARA: <?= htmlspecialchars($horario['ara']) ?></p>
                        </div>
                        <div class="direita">
                            <p>Sala: <?= htmlspecialchars($horario['sala']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum horário encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>