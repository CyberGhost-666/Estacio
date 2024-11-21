<?php
    require_once '../php/config.php';

    if (!empty($_GET['usuario'])) {
        $usuario = $_GET['usuario'];

        try {
            $sql = "SELECT nome, usuario, tipo_usuario FROM usuario WHERE usuario = :u";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':u', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuarioData) {
                die("Usuário Não Encontrado!");
            }
        }
        catch (PDOException $e) {
            die("Erro ao Buscar Dados: " . $e->getMessage());
        }
    }
    else {
        header("Location: ../pages/usuarios-admin.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/estacio-favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/formulario.css">
    <title>Centro Universitário Estácio de Sá - Editar</title>
</head>
<body>
    <div class="area-formulario">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <form action="../php/atualizar-usuario.php" method="post">
        <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuarioData['usuario']); ?>">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($usuarioData['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="tipo_usuario">Tipo de Usuário</label>
            <select name="tipoUsuario" id="tipoUsuario" required>
                <option value="admin" <?= $usuarioData['tipoUsuario'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="professor" <?= $usuarioData['tipoUsuario'] === 'professor' ? 'selected' : ''; ?>>Professor</option>
                <option value="telao" <?= $usuarioData['tipoUsuario'] === 'telao' ? 'selected' : ''; ?>>Telão</option>
            </select>
        </div>

        <div class="acoes-form">
            <a href="../pages/usuarios-admin.php" class="btn-cancelar">Cancelar</a>
            <button type="submit" class="btn-cadastrar">Salvar</button>
        </div>
    </form>
    </div>
</body>
</html>