<?php
require_once 'Database.php'; // Arquivo onde estão as classes

// Conexão com o banco de dados
$database = new Database('localhost', 'banco_sistema', 'root', '');
$conexao = $database->getConnection();

// Instância da classe DBClientes
$bdClientes = new DBClientes($conexao);

// Inicializa variáveis para a mensagem de sucesso ou erro
$successMessage = '';
$errorMessage = '';

// Verifica se o ID foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        // Tenta deletar o cliente pelo ID
        if ($bdClientes->delete($id)) {
            $successMessage = "Cliente com ID $id deletado com sucesso.";
        } else {
            $errorMessage = "Erro ao deletar o cliente. Verifique o ID e tente novamente.";
        }
    } else {
        $errorMessage = "Por favor, insira um ID válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        input[type="number"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c0392b;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Deletar Cliente</h1>

        <form method="POST" action="">
            <input type="number" name="id" id="id" placeholder="Digite o ID do cliente" required>
            <button type="submit">Deletar</button>
        </form>

        <div class="message">
            <?php if (!empty($errorMessage)): ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php elseif (!empty($successMessage)): ?>
                <p class="success"><?php echo $successMessage; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>