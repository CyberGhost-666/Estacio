<?php
    require_once '../php/config.php';

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id_horario = intval($_GET['id']);

        try {
            $sql = "SELECT h.id_horario, h.ara, h.sala, h.turno, h.dia_semana, h.id_curso, h.id_materia, h.id_usuario FROM horario h WHERE h.id_horario = :ih";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ih', $id_horario, PDO::PARAM_INT);
            $stmt->execute();
            $horario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$horario) {
                die("Horário Não Encontrado!");
            }
        }
        catch (PDOException $e) {
            die("Erro ao Buscar Horário: " . $e->getMessage());
        }
    }
    else {
        die("ID do Horário Inválido!");
    }

    try {
        $cursos = $pdo->query("SELECT id_curso, nome FROM curso")->fetchAll(PDO::FETCH_ASSOC);
        $materias = $pdo->query("SELECT id_materia, nome FROM materia")->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = $pdo->query("SELECT id_usuario, nome FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Erro ao Buscar Dados Auxiliares: " . $e->getMessage());
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
    <title>Centro Universitário Estácio de Sá - Editar Horário</title>
</head>
<body>
    <div class="area-formulario">
        <div class="logo">
            <img src="https://cdn.portal.estacio.br/logotipo_marca_estacio_preto_HOME_d4bc9da518_ed6850a937.svg" alt="Logo da Estácio">
        </div>

        <form action="../php/atualizar-horario.php" method="post">
            <input type="hidden" name="id_horario" value="<?= htmlspecialchars($horario['id_horario']); ?>">
            <div class="form-group">
                <label for="ara">ARA</label>
                <input type="text" name="ara" id="ara" value="<?= htmlspecialchars($horario['ara']); ?>">
            </div>
            <div class="form-group">
                <label for="sala">Sala</label>
                <input type="text" name="sala" id="sala" value="<?= htmlspecialchars($horario['sala']); ?>">
            </div>
            <div class="form-group">
                <label for="turno">Turno</label>
                <select name="turno" id="turno" required>
                    <option value="manha" <?= $horario['turno'] === 'manha' ? 'selected' : ''; ?>>Manhã</option>
                    <option value="tarde" <?= $horario['turno'] === 'tarde' ? 'selected' : ''; ?>>Tarde</option>
                    <option value="noite" <?= $horario['turno'] === 'noite' ? 'selected' : ''; ?>>Noite</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dia_semana">Dia da Semana</label>
                <select name="dia_semana" id="dia_semana" required>
                    <?php
                        $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta'];
                        foreach ($dias as $dia) {
                            $selected = $horario['dia_semana'] === $dia ? 'selected' : '';
                            echo "<option value=\"$dia\" $selected>" . ucfirst($dia) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_curso">Curso</label>
                <select id="id_curso" name="id_curso" required>
                    <?php foreach ($cursos as $curso): ?>
                        <option value="<?= $curso['id_curso']; ?>" <?= $curso['id_curso'] == $horario['id_curso'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($curso['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_materia">Matéria</label>
                <select id="id_materia" name="id_materia" required>
                    <?php foreach ($materias as $materia): ?>
                        <option value="<?= $materia['id_materia']; ?>" <?= $materia['id_materia'] == $horario['id_materia'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($materia['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_usuario">Professor</label>
                <select id="id_usuario" name="id_usuario" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id_usuario']; ?>" <?= $usuario['id_usuario'] == $horario['id_usuario'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($usuario['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="acoes-form">
                <a href="../pages/horarios.php" class="btn-cancelar">Voltar</a>
                <button type="submit" class="btn-cadastrar">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>