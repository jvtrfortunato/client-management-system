<?php
require_once 'DataBase.php'; // Arquivo onde estão as classes

// Conexão com o banco de dados
$database = new Database('localhost', 'banco_sistema', 'root', '');
$conexao = $database->getConnection();

// Instância da classe DBClientes
$bdClientes = new DBClientes($conexao);

// Inicializa variáveis para os clientes e mensagem de erro
$clientesBuscados = null;
$errorMessage = '';

// Verifica se um nome foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        $nomeBusca = $_POST['nome'];

        // Tenta recuperar os clientes pelo nome
        $clientesBuscados = $bdClientes->recoveryByName($nomeBusca);

        if (!$clientesBuscados || count($clientesBuscados) == 0) {
            $errorMessage = "Nenhum cliente encontrado com o nome: $nomeBusca";
        }
    } else {
        $errorMessage = "Por favor, insira um nome válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery By Name</title>
</head>
<body>
    <h1>Buscar Clientes por Nome</h1>

    <form method="POST" action="">
        <label for="nome">Digite o nome do cliente:</label>
        <input type="text" name="nome" id="nome" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($clientesBuscados)): ?>
        <h2>Resultados da Busca</h2>
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
                <?php foreach ($clientesBuscados as $cliente): ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['cpf']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (!empty($errorMessage)): ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</body>
</html>
