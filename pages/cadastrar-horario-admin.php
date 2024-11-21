<?php
    session_start();

    include '../php/config.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
        header("Location: ../pages/login.html");
        exit;
    }

    try {
        $cursos = $pdo->query("SELECT id_curso, nome FROM curso ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
        $materias = $pdo->query("SELECT id_materia, nome FROM materia ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
        $professores = $pdo->query("SELECT id_usuario, nome FROM usuario WHERE tipo_usuario = 'professor' ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
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

        <form action="../php/cadastro-horario.php" method="post">
            <div class="form-group">
                <label for="curso">Curso</label>
                <div class="input-wrapper">
                    <select name="curso" id="curso" required>
                        <option value="">Selecione um Curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="../pages/cadastrar-curso.php" class="icon"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="form-group">
                <label for="materia">Matéria</label>
                <div class="input-wrapper">
                    <select name="materia" id="materia" required>
                        <option value="">Selecione uma Matéria</option>
                        <?php foreach ($materias as $materia): ?>
                            <option value="<?= $materia['id_materia'] ?>"><?= htmlspecialchars($materia['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="../pages/cadastrar-materia.php" class="icon"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="form-group">
                <label for="professor">Professor</label>
                <div class="input-wrapper">
                    <select name="professor" id="professor" required>
                        <option value="">Selecione um Professor</option>
                        <?php foreach ($professores as $professor): ?>
                            <option value="<?= $professor['id_usuario'] ?>"><?= htmlspecialchars($professor['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="../pages/cadastrar-usuario-admin.php" class="icon"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="form-group">
                <label for="ara">ARA</label>
                <input type="text" name="ara" id="ara" placeholder="Digite o ara..." required>
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="text" name="sala" id="sala" placeholder="Digite a sala..." required>
            </div>
            <div class="form-group">
                <label for="turno">Turno</label>
                <select name="turno" id="turno">
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>
            <div class="form-group">
                <label for="diaSemana">Dia da Semana</label>
                <select name="diaSemana" id="diaSemana">
                    <option value="segunda">Segunda-Feira</option>
                    <option value="terca">Terça-Feira</option>
                    <option value="quarta">Quarta-Feira</option>
                    <option value="quinta">Quinta-Feira</option>
                    <option value="sexta">Sexta-Feira</option>
                </select>
            </div>

            <div class="acoes-form">
                <a href="../pages/horarios.php" class="btn-cancelar">Voltar</a>
                <button type="submit" class="btn-cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>