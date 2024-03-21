<?php
# Get the logged user from the session
session_start();
$email = $_SESSION['email'];

# Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'seguranca01');

# Query the database
$sql = "SELECT * FROM users WHERE email = '$email'";

# Get the user from the database
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Administração</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .logout-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Página de Administração - <?php echo $user['name'];  ?> Cargo: <?php echo ucfirst($user['role']) ?></h1>

        <?php if ($user['role'] === 'financeiro') : ?>
            <h2>Transações Bancárias</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Linhas da tabela de transações bancárias -->
                    <tr>
                        <td>1</td>
                        <td>2024-03-21</td>
                        <td>R$ 100,00</td>
                        <td>Pagamento de fornecedor</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2024-03-22</td>
                        <td>R$ 50,00</td>
                        <td>Compra de material de escritório</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if ($user['role'] === 'ti') : ?>
            <h2>Tickets do Sistema</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Assunto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Linhas da tabela de tickets do sistema -->
                    <tr>
                        <td>1</td>
                        <td>2024-03-21</td>
                        <td>Problema com o sistema de pagamento</td>
                        <td>Aberto</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>2024-03-22</td>
                        <td>Erro ao enviar emails automáticos</td>
                        <td>Fechado</td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>

</html>