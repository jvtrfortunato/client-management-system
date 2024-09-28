<?php
require_once 'Database.php'; // Arquivo onde estão as classes

// Conexão com o banco de dados
$database = new Database('localhost', 'banco_sistema', 'root', '');
$conexao = $database->getConnection();

// Instância da classe DBClientes
$bdClientes = new DBClientes($conexao);

// Inicializa variáveis para o cliente e mensagem de erro
$clienteBuscado = null;
$errorMessage = '';

// Verifica se um ID foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idBusca']) && !empty($_POST['idBusca'])) {
        $idBusca = $_POST['idBusca'];

        // Tenta recuperar o cliente pelo ID
        $clienteBuscado = $bdClientes->recoveryById($idBusca);

        if (!$clienteBuscado) {
            $errorMessage = "Nenhum cliente encontrado com o ID: $idBusca";
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
    <title>Buscar Cliente por ID</title>
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
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="number"] {
            padding: 10px;
            width: 250px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar Cliente por ID</h1>

        <form method="POST" action="">
            <input type="number" name="idBusca" id="idBusca" placeholder="Digite o ID do cliente" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if ($clienteBuscado): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo htmlspecialchars($clienteBuscado['id']); ?></td>
                        <td><?php echo htmlspecialchars($clienteBuscado['nome']); ?></td>
                        <td><?php echo htmlspecialchars($clienteBuscado['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($clienteBuscado['email']); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php elseif (!empty($errorMessage)): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>