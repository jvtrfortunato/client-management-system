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
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $idBusca = $_POST['id'];

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
    <title>Recovery By Id</title>
</head>
<body>
    <h1>Buscar Cliente por ID</h1>

    <form method="POST" action="">
        <label for="id">Digite o ID do cliente:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($clienteBuscado)): ?>
        <h2>Dados do Cliente</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <td><?php echo $clienteBuscado['id']; ?></td>
            </tr>
            <tr>
                <th>Nome</th>
                <td><?php echo $clienteBuscado['nome']; ?></td>
            </tr>
            <tr>
                <th>CPF</th>
                <td><?php echo $clienteBuscado['cpf']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $clienteBuscado['email']; ?></td>
            </tr>
        </table>
    <?php elseif (!empty($errorMessage)): ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</body>
</html>