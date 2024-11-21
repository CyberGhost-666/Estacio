<?php
    session_start();
    
    include '../php/config.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
        header("Location: ../pages/login.html");
        exit;
    }

    $nomeUsuario = $_SESSION['nome'];

    try {
        $stmt = $pdo->query("
            SELECT 
                p.id_pedido_alteracao,
                c.nome AS curso,
                m.nome AS materia,
                u.nome AS professor,
                p.ara,
                p.sala,
                p.turno,
                p.dia_semana
            FROM pedido_alteracao p
            JOIN curso c ON p.id_curso = c.id_curso
            JOIN materia m ON p.id_materia = m.id_materia
            JOIN usuario u ON p.id_usuario = u.id_usuario
            ORDER BY p.id_pedido_alteracao DESC
        ");

        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro ao buscar pedidos de alteração: " . $e->getMessage();
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
    <script src="../scripts/script.js" defer></script>
    <title>Centro Universitário Estácio de Sá - Admin</title>
</head>
<body>
    <header class="menu">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <nav class="menu-itens">
            <a href="../pages/index-admin.php">Home</a>
            <a href="../pages/usuarios-admin.php">Usuários</a>
            <a href="../pages/pedidos-admin.php">Pedidos</a>
            <a href="../pages/horarios.php">Horários</a>
        </nav>

        <div class="usuario-logado">
            <span>
                Bem-Vindo(a), 
                <strong>
                    <a href="#" id="nome-usuario" onclick="toggleMenu()"><?= htmlspecialchars($nomeUsuario) ?></a>
                </strong>
            </span>

            <div id="menu-deslogar" class="menu-deslogar">
                <a href="../php/logout.php">Deslogar</a>
            </div>
        </div>
    </header>

    <main class="area-cards">
        <?php if (!empty($pedidos)): ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="card">
                    <h1><?= htmlspecialchars($pedido['curso']) ?></h1>
                    <div class="line"></div>
                    <div class="info-card">
                        <div class="esquerda">
                            <h2><?= htmlspecialchars($pedido['materia']) ?></h2>
                            <p>Professor(a): <?= htmlspecialchars($pedido['professor']) ?></p>
                            <p>ARA: <?= htmlspecialchars($pedido['ara']) ?></p>
                        </div>
                        <div class="direita">
                            <p>Sala: <?= htmlspecialchars($pedido['sala']) ?></p>
                            <p>Turno: <?= htmlspecialchars($pedido['turno']) ?></p>
                            <p>Dia: <?= htmlspecialchars($pedido['dia_semana']) ?></p>
                        </div>
                    </div>
                    <div class="acoes-card">
                        <form action="../php/processar-pedido.php" method="post">
                            <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido_alteracao'] ?>">
                            <input type="hidden" name="acao" value="rejeitar">
                            <button type="submit" class="btn-rejeitar">Rejeitar</button>
                        </form>
                        <form action="../php/processar-pedido.php" method="post">
                            <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido_alteracao'] ?>">
                            <input type="hidden" name="acao" value="aceitar">
                            <button type="submit" class="btn-aceitar">Aceitar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum pedido de alteração encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>