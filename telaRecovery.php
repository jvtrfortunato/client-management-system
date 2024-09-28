<?php
require_once 'Database.php'; //Arquivo onde estão as classes

// Cria uma nova conexão com o banco de dados
$database = new Database('localhost', 'banco_sistema', 'root', '');
$conexao = $database->getConnection();

// Cria uma instância da classe DBClientes passando a conexão como parâmetro
$bdClientes = new DBClientes($conexao);

// Recupera todos os clientes
$clientes = $bdClientes->recovery();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Todos os Clientes</title>
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
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <?php if (!empty($clientes)): ?>
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
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                            <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum cliente encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>