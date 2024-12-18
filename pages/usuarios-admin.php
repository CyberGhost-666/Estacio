<?php
    session_start();

    require_once '../php/config.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
        header("Location: ../pages/login.html");
        exit;
    }

    $nomeUsuario = $_SESSION['nome'];

    try {
        $sql = "SELECT nome, usuario, tipo_usuario FROM usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Erro ao Buscar Usuários: " . $e->getMessage());
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
    <script src="../scripts/script.js" defer></script>
    <title>Centro Universitário Estácio de Sá - Usuários</title>
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

    <main class="area-tabela">
        <a href="../pages/cadastrar-usuario-admin.php" class="btn-cdt">Cadastrar Usuário</a>
        <table class="tabela">
            <thead>
                <tr class="tabela-itens">
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Tipo de Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr class="tabela-itens">
                            <td><?= htmlspecialchars($usuario['nome']); ?></td>
                            <td><?= htmlspecialchars($usuario['usuario']); ?></td>
                            <td><?= htmlspecialchars($usuario['tipo_usuario']); ?></td>
                            <td class="btn-acoes">
                                <button type="button" class="btn-edit" onclick="window.location.href='../pages/editar-usuario.php?usuario=<?= urldecode($usuario['usuario']); ?>'">Editar</button>

                                <form action="../php/deletar-usuario.php" method="post" onsubmit="return confirmarDelecao('<?= htmlspecialchars($usuario['usuario']); ?>')">
                                    <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario['usuario']); ?>">
                                    <button type="submit" class="btn-delete">Deletar</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum Usuário Encontrado!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>