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
    <title>Recovery</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    
    <?php if (!empty($clientes)): ?>
        <table border="1">
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
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['cpf']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum cliente encontrado.</p>
    <?php endif; ?>
</body>
</html>