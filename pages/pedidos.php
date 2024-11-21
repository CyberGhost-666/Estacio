<?php
    session_start();
    
    include '../php/config.php';

    if (!isset($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] !== 'professor') {
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
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../estilos/formulario.css">
    <title>Centro Universitário Estácio de Sá - Pedido</title>
</head>
<body>
    <div class="area-formulario">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <form action="../php/pedido-alteracao.php" method="post">
            <div class="form-group">
                <label for="curso">Curso</label>
                <div class="input-wrapper">
                    <select name="id_curso" id="curso" required>
                        <option value="">Selecione um Curso</option>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="cadastro_curso.php" class="icon-link" title="Cadastrar Curso"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        
            <div class="form-group">
                <label for="materia">Matéria</label>
                <div class="input-wrapper">
                    <select name="id_materia" id="materia" required>
                        <option value="">Selecione uma Matéria</option>
                        <?php foreach ($materias as $materia): ?>
                            <option value="<?= $materia['id_materia'] ?>"><?= htmlspecialchars($materia['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="cadastro_materia.php" class="icon-link" title="Cadastrar Matéria"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        
            <div class="form-group">
                <label for="professor">Professor</label>
                <div class="input-wrapper">
                    <select name="id_usuario" id="professor" required>
                        <option value="">Selecione um Professor</option>
                        <?php foreach ($professores as $professor): ?>
                            <option value="<?= $professor['id_usuario'] ?>"><?= htmlspecialchars($professor['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="cadastro_professor.php" class="icon-link" title="Cadastrar Professor"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        
            <div class="form-group">
                <label for="ara">ARA</label>
                <input type="text" name="ara" id="ara" placeholder="Digite o ARA..." required>
            </div>
        
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="text" name="sala" id="sala" placeholder="Digite a Sala..." required>
            </div>
        
            <div class="form-group">
                <label for="turno">Turno</label>
                <select name="turno" id="turno" required>
                    <option value="">Selecione o Turno</option>
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>
        
            <div class="form-group">
                <label for="dia_semana">Dia da Semana</label>
                <select name="dia_semana" id="dia_semana" required>
                    <option value="">Selecione o Dia</option>
                    <option value="segunda">Segunda-Feira</option>
                    <option value="terca">Terça-Feira</option>
                    <option value="quarta">Quarta-Feira</option>
                    <option value="quinta">Quinta-Feira</option>
                    <option value="sexta">Sexta-Feira</option>
                </select>
            </div>
        
            <div class="acoes-form">
                <a href="../pages/index-professor.php" class="btn-cancelar">Voltar</a>
                <button type="submit" class="btn-cadastrar">Solicitar</button>
            </div>
        </form>
    </div>
</body>
</html>