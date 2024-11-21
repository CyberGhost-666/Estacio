<?php
    require_once '../php/config.php';

    try {
        $sql = "SELECT h.id_horario, h.ara, h.sala, h.turno, h.dia_semana, c.nome AS curso, m.nome AS materia, u.nome AS professor FROM horario h INNER JOIN curso c ON h.id_curso = c.id_curso INNER JOIN materia m ON h.id_materia = m.id_materia INNER JOIN usuario u ON h.id_usuario = u.id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Erro ao Buscar Horários: " . $e->getMessage());
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
    <link rel="stylesheet" href="../estilos/tabela.css">
    <title>Centro Universitário Estácio de Sá - Horários</title>
</head>
<body>
    <header class="menu">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <nav class="menu-itens">
            <a href="../pages/index-admin.html">Home</a>
            <a href="../pages/usuarios-admin.php">Usuários</a>
            <a href="#">Pedidos</a>
            <a href="../pages/horarios.php">Horários</a>
        </nav>

        <div class="usuario-logado">
            <span>Bem-Vindo(a), <strong>Fred Lopes</strong></span>
        </div>
    </header>

    <main class="area-tabela">
        <a href="../pages/cadastrar-horario-admin.php" class="btn-cdt">Cadastrar Horário</a>
        <table class="tabela">
            <thead>
                <tr class="tabela-itens">
                    <th>Curso</th>
                    <th>Matéria</th>
                    <th>Professor</th>
                    <th>ARA</th>
                    <th>Sala</th>
                    <th>Dia da Semana</th>
                    <th>Turno</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($horarios)): ?>
                    <?php foreach ($horarios as $horario): ?>
                        <tr class="tabela-itens">
                            <td><?= htmlspecialchars($horario['curso']); ?></td>
                            <td><?= htmlspecialchars($horario['materia']); ?></td>
                            <td><?= htmlspecialchars($horario['professor']); ?></td>
                            <td><?= htmlspecialchars($horario['ara']); ?></td>
                            <td><?= htmlspecialchars($horario['sala']); ?></td>
                            <td><?= ucfirst(htmlspecialchars($horario['dia_semana'])); ?></td>
                            <td><?= ucfirst(htmlspecialchars($horario['turno'])); ?></td>
                            <td class="btn-acoes">
                                <a href="editar-horario.php?id=<?= $horario['id_horario']; ?>" class="btn-edit">Editar</a>

                                <form action="../php/deletar-horario.php" method="post">
                                    <input type="hidden" name="id_horario" value="<?= $horario['id_horario']; ?>">
                                    <button type="submit" class="btn-delete">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Nenhum Horário Encontrado!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>