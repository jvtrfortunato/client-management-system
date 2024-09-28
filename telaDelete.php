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
    <title>Delete</title>
</head>
<body>
    <h1>Deletar Cliente</h1>

    <form method="POST" action="">
        <label for="id">ID do Cliente:</label>
        <input type="number" name="id" id="id" required><br><br>

        <button type="submit">Deletar Cliente</button>
    </form>

    <?php if (!empty($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php elseif (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</body>
</html>