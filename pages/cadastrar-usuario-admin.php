<?php
    session_start();

    require_once '../php/config.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
        header("Location: ../pages/login.html");
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
    <link rel="stylesheet" href="../estilos/formulario.css">
    <title>Centro Universitário Estácio de Sá - Cadastro Usuário</title>
</head>
<body>
    <div class="area-formulario">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <form method="post" action="../php/cadastro.php">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome..." required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite o usuário..." required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite a senha..." required>
            </div>
            <div class="form-group">
                <label for="confSenha">Confirmar Senha</label>
                <input type="password" name="confSenha" id="confSenha" placeholder="Digite a senha novamente...">
            </div>
            <div class="form-group">
                <label for="tipoUsuario">Tipo de Usuário</label>
                <select name="tipoUsuario" id="tipoUsuario" required>
                    <option value="admin">Admin</option>
                    <option value="professor">Professor</option>
                    <option value="telao">Telão</option>
                </select>
            </div>

            <div class="acoes-form">
                <a href="../pages/usuarios-admin.php" class="btn-cancelar">Voltar</a>
                <button type="submit" class="btn-cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>