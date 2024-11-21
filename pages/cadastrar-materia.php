<?php
    include '../php/config.php';

    try {
        $cursos = $pdo->query("SELECT id_curso, nome FROM curso ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo "Erro ao Consultar Dados do Banco: " . $e->getMessage();
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
    <title>Centro Universitário Estácio de Sá - Cadastro Matéria</title>
</head>
<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/formulario.css">
    <title>Centro Universitário Estácio de Sá - Cadastro Horário</title>
</head>
<body>
    <div class="area-formulario">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <form action="../php/cadastro-materia.php" method="post">
            <div class="form-group">
                <label for="curso">Curso</label>
                <div class="input-wrapper">
                    <select name="curso" id="curso" required>
                        <option value="">Selecione um Curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="../pages/cadastrar-curso.html" class="icon"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="form-group">
                <label for="materia">Matéria</label>
                <input type="text" name="materia" id="materia" placeholder="Digite a matéria..." required>
            </div>

            <div class="acoes-form">
                <a href="../pages/cadastrar-horario-admin.php" class="btn-cancelar">Voltar</a>
                <button type="submit" class="btn-cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>