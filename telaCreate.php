<?php
require_once 'Database.php'; // Inclui o arquivo onde as classes estão definidas
    
// Cria uma nova conexão com o banco de dados
$database = new Database('localhost', 'banco_sistema', 'root', '');
$conexao = $database->getConnection();

// Cria uma instância da classe DBClientes passando a conexão como parâmetro
$bdClientes = new DBClientes($conexao);

// Inicializa variáveis para a mensagem de sucesso ou erro
$successMessage = '';
$errorMessage = '';

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'], $_POST['nome'], $_POST['cpf'], $_POST['email']) &&
        !empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email'])) {

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];

        // Tenta criar o cliente
        if ($bdClientes->create($id, $nome, $cpf, $email)) {
            $successMessage = "Cliente criado com sucesso.";
        } else {
            $errorMessage = "Erro ao criar o cliente. Verifique os dados e tente novamente.";
        }
    } else {
        $errorMessage = "Por favor, preencha todos os campos corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h1>Criar Novo Cliente</h1>

    <form method="POST" action="">
        <label for="id">ID do Cliente:</label>
        <input type="number" name="id" id="id" required><br><br>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <button type="submit">Criar Cliente</button>
    </form>

    <?php if (!empty($successMessage)): ?>
        <p style="color: green;"><?php echo $successMessage; ?></p>
    <?php elseif (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
</body>
</html>