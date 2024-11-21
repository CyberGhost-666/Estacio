<?php
    include '../php/config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        try {
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($senha, $user['senha'])) {
                session_start();
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

                switch ($user['tipo_usuario']) {
                    case 'admin':
                        header("Location: ../pages/index-admin.php");
                        break;
                    case 'professor':
                        header("Location: ../pages/index-professor.php");
                        break;
                    case 'telao':
                        header("Location: #");
                        break;
                    default:
                        echo "<script>alert('Tipo de usuário desconhecido.'); window.location.href = '../pages/login.html';</script>";
                        break;
                }
                exit;
            } else {
                echo "<script>alert('Usuário ou senha inválidos!'); window.location.href = '../pages/login.html';</script>";
            }
        } catch (PDOException $e) {
            echo "Erro ao validar login: " . $e->getMessage();
        }
    }
?>